<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function generateInvoice(Booking $booking)
    {
        // Check if user is authorized to view this invoice
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if booking status is valid for invoice
        if (!in_array($booking->status, ['menunggu', 'aktif', 'selesai', 'dibatalkan'])) {
            abort(404, 'Invoice not available.');
        }

        $pdf = Pdf::loadView('pdfs.invoice', [
            'booking' => $booking,
            'transaction' => $booking->transaction
        ]);

        return $pdf->download('invoice-' . $booking->id . '.pdf');
    }
}