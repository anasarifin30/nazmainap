<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Homestay;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $owner = Auth::user();
        
        // Get owner's homestays
        $homestays = Homestay::where('user_id', $owner->id)->get();
        $homestayIds = $homestays->pluck('id');
        
        // Get rooms from owner's homestays
        $rooms = Room::whereIn('homestay_id', $homestayIds)->get();
        $roomIds = $rooms->pluck('id');
        
        // Current month data
        $currentMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        
        // Monthly Revenue (dari booking homestay owner)
        $monthlyRevenue = Booking::whereIn('homestay_id', $homestayIds)
            ->where('status', 'selesai')
            ->where('created_at', '>=', $currentMonth)
            ->sum('total_price');
            
        $lastMonthRevenue = Booking::whereIn('homestay_id', $homestayIds)
            ->where('status', 'selesai')
            ->whereBetween('created_at', [$lastMonth, $currentMonth])
            ->sum('total_price');
            
        $revenueGrowth = $lastMonthRevenue > 0 
            ? (($monthlyRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
            : 0;
        
        // Total Bookings This Month (dari homestay owner)
        $monthlyBookings = Booking::whereIn('homestay_id', $homestayIds)
            ->where('created_at', '>=', $currentMonth)
            ->count();
            
        $lastMonthBookings = Booking::whereIn('homestay_id', $homestayIds)
            ->whereBetween('created_at', [$lastMonth, $currentMonth])
            ->count();
            
        $bookingGrowth = $lastMonthBookings > 0 
            ? (($monthlyBookings - $lastMonthBookings) / $lastMonthBookings) * 100 
            : 0;
        
        // Total Rooms Available
        $totalRooms = $rooms->sum('total_rooms');
        
        // Currently Occupied Rooms (dari booking_details)
        $occupiedRoomsCount = DB::table('booking_details')
            ->join('bookings', 'booking_details.booking_id', '=', 'bookings.id')
            ->whereIn('booking_details.room_id', $roomIds)
            ->where('bookings.check_in', '<=', Carbon::today())
            ->where('bookings.check_out', '>', Carbon::today())
            ->whereIn('bookings.status', ['menunggu', 'aktif'])
            ->sum('booking_details.quantity');
            
        // Occupancy Rate based on total bookings vs available rooms
        $occupancyRate = $totalRooms > 0 ? ($occupiedRoomsCount / $totalRooms) * 100 : 0;
        
        // Available Rooms
        $availableRooms = $totalRooms - $occupiedRoomsCount;
        
        // Recent Activities (dari booking homestay owner)
        $recentBookings = Booking::whereIn('homestay_id', $homestayIds)
            ->with(['homestay', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        // Today's Check-ins and Check-outs
        $todayCheckins = Booking::whereIn('homestay_id', $homestayIds)
            ->where('check_in', Carbon::today())
            ->whereIn('status', ['menunggu', 'aktif'])
            ->with(['homestay', 'user'])
            ->get();
            
        $todayCheckouts = Booking::whereIn('homestay_id', $homestayIds)
            ->where('check_out', Carbon::today())
            ->where('status', 'aktif')
            ->with(['homestay', 'user'])
            ->get();
        
        // Monthly Booking Chart Data (Last 6 months)
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthStart = $month->copy()->startOfMonth();
            $monthEnd = $month->copy()->endOfMonth();
            
            $bookingCount = Booking::whereIn('homestay_id', $homestayIds)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
                
            $revenue = Booking::whereIn('homestay_id', $homestayIds)
                ->where('status', 'selesai')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->sum('total_price');
                
            $chartData[] = [
                'month' => $month->format('M Y'),
                'bookings' => $bookingCount,
                'revenue' => $revenue
            ];
        }
        
        // Room Type Popular (berdasarkan booking_details)
        $roomTypeStats = DB::table('rooms')
            ->leftJoin('booking_details', 'rooms.id', '=', 'booking_details.room_id')
            ->leftJoin('bookings', 'booking_details.booking_id', '=', 'bookings.id')
            ->whereIn('rooms.homestay_id', $homestayIds)
            ->where(function($query) {
                $query->whereNull('bookings.created_at')
                      ->orWhere('bookings.created_at', '>=', Carbon::now()->subMonths(3));
            })
            ->select('rooms.name', 
                     DB::raw('SUM(rooms.total_rooms) as total_rooms'),
                     DB::raw('COUNT(booking_details.id) as bookings_count'))
            ->groupBy('rooms.name')
            ->orderByDesc('bookings_count')
            ->take(5)
            ->get()
            ->map(function($item) {
                return [
                    'name' => $item->name,
                    'bookings' => $item->bookings_count,
                    'total_rooms' => $item->total_rooms
                ];
            });
        
        // Total Homestays Count
        $totalHomestays = $homestays->count();
        
        // Active Bookings Today
        $activeBookingsToday = Booking::whereIn('homestay_id', $homestayIds)
            ->where('status', 'aktif')
            ->where('check_in', '<=', Carbon::today())
            ->where('check_out', '>', Carbon::today())
            ->count();
        
        // Upcoming Check-ins (next 7 days)
        $upcomingCheckins = Booking::whereIn('homestay_id', $homestayIds)
            ->where('check_in', '>', Carbon::today())
            ->where('check_in', '<=', Carbon::today()->addDays(7))
            ->whereIn('status', ['menunggu', 'belum dibayar'])
            ->with(['homestay', 'user'])
            ->orderBy('check_in')
            ->get();
        
        // Pending Payments
        $pendingPayments = Booking::whereIn('homestay_id', $homestayIds)
            ->where('status', 'belum dibayar')
            ->where('payment_deadline', '>', Carbon::now())
            ->count();
        
        return view('owner.dashboard', compact(
            'homestays',
            'monthlyRevenue',
            'revenueGrowth',
            'monthlyBookings',
            'bookingGrowth',
            'occupancyRate',
            'totalRooms',
            'availableRooms',
            'recentBookings',
            'todayCheckins',
            'todayCheckouts',
            'chartData',
            'roomTypeStats',
            'totalHomestays',
            'activeBookingsToday',
            'upcomingCheckins',
            'pendingPayments'
        ));
    }
}