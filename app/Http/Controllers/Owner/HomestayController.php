<?php

namespace App\Http\Controllers\Owner;

use App\Models\Homestay;
use App\Models\Room;
use App\Models\PhotoCategory;
use App\Models\HomestayPhoto;
use App\Models\RoomPhoto;
use App\Models\Facility;
use App\Models\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homestays = Homestay::with(['rooms' => function ($query) {
                $query->orderBy('price', 'asc');
            }, 'homestayPhotos' => function ($query) {
                $query->where('is_cover', true)->first();
            }])
            ->withCount([
                'rooms',
                'rooms as available_rooms_count' => function ($query) {
                    $query->whereDoesntHave('bookingDetails', function ($subQuery) {
                        $subQuery->whereHas('booking', function ($bookingQuery) {
                            $bookingQuery->where('status', 'aktif')
                                        ->where('check_in', '<=', now())
                                        ->where('check_out', '>', now());
                        });
                    });
                }
            ])
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($homestay) {
                // Calculate min price from rooms
                $homestay->min_price = $homestay->rooms->min('price') ?? 0;
                
                // Get cover photo
                $homestay->cover_photo = $homestay->homestayPhotos->where('is_cover', true)->first();
                
                // Calculate occupancy rate
                $totalRooms = $homestay->rooms_count;
                $availableRooms = $homestay->available_rooms_count;
                $homestay->occupancy_rate = $totalRooms > 0 ? (($totalRooms - $availableRooms) / $totalRooms) * 100 : 0;
                
                return $homestay;
            });

        return view('owner.homestay.index', compact('homestays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner.homestay.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'rules' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        DB::beginTransaction();
        
        try {
            // Create homestay
            $homestay = Homestay::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi ?? 'DI Yogyakarta',
                'status' => 'menunggu'
            ]);

            // Store rules if provided
            if ($request->has('rules')) {
                foreach ($request->rules as $rule) {
                    Rule::create([
                        'homestay_id' => $homestay->id,
                        'rule_text' => $rule
                    ]);
                }
            }

            // Store photos if provided
            if ($request->hasFile('photos')) {
                $this->storePhotos($request->file('photos'), $homestay->id);
            }

            DB::commit();

            return redirect()->route('owner.homestay')
                           ->with('success', 'Homestay berhasil dibuat dan menunggu verifikasi.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $homestay = Homestay::with([
                'rooms.roomPhotos',
                'homestayPhotos.category',
                'rules'
            ])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('owner.homestay.show', compact('homestay'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $homestay = Homestay::with(['rules', 'homestayPhotos'])
                           ->where('user_id', Auth::id())
                           ->findOrFail($id);

        return view('owner.homestay.edit', compact('homestay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $homestay = Homestay::where('user_id', Auth::id())->findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        DB::beginTransaction();
        
        try {
            $homestay->update([
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'status' => 'menunggu' // Reset status for re-verification
            ]);

            // Update rules
            if ($request->has('rules')) {
                $homestay->rules()->delete();
                foreach ($request->rules as $rule) {
                    Rule::create([
                        'homestay_id' => $homestay->id,
                        'rule_text' => $rule
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('owner.homestay')
                           ->with('success', 'Homestay berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $homestay = Homestay::where('user_id', Auth::id())->findOrFail($id);
        
        DB::beginTransaction();
        
        try {
            // Delete photos from storage
            foreach ($homestay->homestayPhotos as $photo) {
                Storage::disk('public')->delete($photo->photo_path);
            }

            // Delete homestay (cascade will handle related records)
            $homestay->delete();

            DB::commit();

            return redirect()->route('owner.homestay')
                           ->with('success', 'Homestay berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Store photos for homestay
     */
    private function storePhotos($photos, $homestayId)
    {
        // Get photo categories
        $categories = PhotoCategory::all()->keyBy('name');
        
        foreach ($photos as $index => $photo) {
            $path = $photo->store('homestay-photos', 'public');
            
            // Determine category based on filename or use default
            $categoryId = $categories->get('bedroom', $categories->first())->id;
            
            HomestayPhoto::create([
                'homestay_id' => $homestayId,
                'category_id' => $categoryId,
                'photo_path' => $path,
                'is_cover' => $index === 0 // First photo as cover
            ]);
        }
    }

    /**
     * Show add homestay form steps
     */
    public function addHomestay()
    {
        return view('owner.homestay.addhomestay');
    }

    public function addAddress()
    {
        return view('owner.homestay.addaddress');
    }

    public function addPhoto()
    {
        return view('owner.homestay.addphoto');
    }

    public function addAvailability()
    {
        return view('owner.homestay.addavailability');
    }

    /**
     * Create new room for homestay
     */
    public function createRoom(string $homestayId)
    {
        $homestay = Homestay::where('user_id', Auth::id())->findOrFail($homestayId);
        $facilities = Facility::all();
        
        return view('owner.homestay.create-room', compact('homestay', 'facilities'));
    }

    /**
     * Store new room
     */
    public function storeRoom(Request $request, string $homestayId)
    {
        $homestay = Homestay::where('user_id', Auth::id())->findOrFail($homestayId);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'max_guests' => 'required|integer|min:1',
            'total_rooms' => 'required|integer|min:1',
            'facilities' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        DB::beginTransaction();
        
        try {
            $room = Room::create([
                'homestay_id' => $homestay->id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'max_guests' => $request->max_guests,
                'total_rooms' => $request->total_rooms
            ]);

            // Attach facilities
            if ($request->has('facilities')) {
                $room->facilities()->attach($request->facilities);
            }

            // Store room photos
            if ($request->hasFile('photos')) {
                $this->storeRoomPhotos($request->file('photos'), $room->id);
            }

            DB::commit();

            return redirect()->route('owner.homestay')
                           ->with('success', 'Kamar berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Store photos for room
     */
    private function storeRoomPhotos($photos, $roomId)
    {
        $categories = PhotoCategory::all()->keyBy('name');
        
        foreach ($photos as $index => $photo) {
            $path = $photo->store('room-photos', 'public');
            
            RoomPhoto::create([
                'room_id' => $roomId,
                'category_id' => $categories->get('bedroom', $categories->first())->id,
                'photo_path' => $path,
                'is_cover' => $index === 0
            ]);
        }
    }

    /**
     * Get homestay statistics
     */
    public function getStats()
    {
        $userId = Auth::id();
        
        $stats = [
            'total_homestays' => Homestay::where('user_id', $userId)->count(),
            'verified_homestays' => Homestay::where('user_id', $userId)
                                          ->where('status', 'terverifikasi')->count(),
            'total_rooms' => Room::whereHas('homestay', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })->sum('total_rooms'),
            'monthly_bookings' => 0, // Will be calculated when booking system is ready
            'monthly_revenue' => 0   // Will be calculated when booking system is ready
        ];

        return response()->json($stats);
    }

    /**
     * STEP 1: Basic Information
     */
    public function createStep1()
    {
        return view('owner.homestay.create-step1');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'rules' => 'nullable|array',
            'facilities' => 'array',
            'facilities.*' => 'exists:facilities,id',
        ]);

        // Store in session
        Session::put('homestay_step1', [
            'name' => $request->name,
            'description' => $request->description,
            'rules' => $request->rules ?? [],
            'facilities' => $request->facilities ?? [],
        ]);

        return redirect()->route('owner.homestay.create.step2');
    }

    /**
     * STEP 2: Address Information
     */
    public function createStep2()
    {
        if (!Session::has('homestay_step1')) {
            return redirect()->route('owner.homestay.create.step1');
        }

        return view('owner.homestay.create-step2');
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'nullable|string|max:100',
        ]);

        // Store in session
        Session::put('homestay_step2', [
            'address' => $request->address,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi ?? 'DI Yogyakarta'
        ]);

        return redirect()->route('owner.homestay.create.step3');
    }

    /**
     * STEP 3: Photos
     */
    public function createStep3()
    {
        if (!Session::has('homestay_step2')) {
            return redirect()->route('owner.homestay.create.step1');
        }

        return view('owner.homestay.create-step3');
    }

    public function storeStep3(Request $request)
    {
        $request->validate([
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('temp-homestay-photos', 'public');
                $photos[] = $path;
            }
        }

        // Store in session
        Session::put('homestay_step3', [
            'photos' => $photos
        ]);

        return redirect()->route('owner.homestay.create.step4');
    }

    /**
     * STEP 4: Availability & Final Submission
     */
    public function createStep4()
    {
        if (!Session::has('homestay_step3')) {
            return redirect()->route('owner.homestay.create.step1');
        }

        return view('owner.homestay.create-step4');
    }

    public function storeStep4(Request $request)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'room_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'max_guests' => 'required|integer|min:1',
            'total_rooms' => 'required|integer|min:1',
            'facilities' => 'nullable|array',
        ]);

        DB::beginTransaction();
        
        try {
            // Get all session data
            $step1 = Session::get('homestay_step1');
            $step2 = Session::get('homestay_step2');
            $step3 = Session::get('homestay_step3');

            // Create homestay
            $homestay = Homestay::create([
                'user_id' => Auth::id(),
                'name' => $step1['name'],
                'description' => $step1['description'],
                'address' => $step2['address'],
                'kelurahan' => $step2['kelurahan'],
                'kecamatan' => $step2['kecamatan'],
                'kabupaten' => $step2['kabupaten'],
                'provinsi' => $step2['provinsi'],
                'status' => 'menunggu'
            ]);

            // Store rules
            if (!empty($step1['rules'])) {
                foreach ($step1['rules'] as $rule) {
                    Rule::create([
                        'homestay_id' => $homestay->id,
                        'rule_text' => $rule
                    ]);
                }
            }

            // Create first room
            $room = Room::create([
                'homestay_id' => $homestay->id,
                'name' => $request->room_name,
                'description' => $request->room_description,
                'price' => $request->price,
                'max_guests' => $request->max_guests,
                'total_rooms' => $request->total_rooms
            ]);

            // Attach facilities to room
            if ($request->has('facilities')) {
                $room->facilities()->attach($request->facilities);
            }

            // Move photos from temp to permanent storage
            if (!empty($step3['photos'])) {
                $categories = PhotoCategory::all()->keyBy('name');
                $defaultCategory = $categories->get('bedroom', $categories->first());
                
                foreach ($step3['photos'] as $index => $tempPath) {
                    // Move from temp to permanent location
                    $newPath = str_replace('temp-homestay-photos', 'homestay-photos', $tempPath);
                    Storage::disk('public')->move($tempPath, $newPath);
                    
                    HomestayPhoto::create([
                        'homestay_id' => $homestay->id,
                        'category_id' => $defaultCategory->id,
                        'photo_path' => $newPath,
                        'is_cover' => $index === 0
                    ]);
                }
            }

            // Clear session data
            Session::forget(['homestay_step1', 'homestay_step2', 'homestay_step3']);

            DB::commit();

            return redirect()->route('owner.homestay')
                           ->with('success', 'Homestay berhasil dibuat dan menunggu verifikasi!');

        } catch (\Exception $e) {
            DB::rollback();
            
            // Clean up temp files
            if (!empty($step3['photos'])) {
                foreach ($step3['photos'] as $tempPath) {
                    Storage::disk('public')->delete($tempPath);
                }
            }
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                        ->withInput();
        }
    }
}
