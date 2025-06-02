<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HandlePaymentErrors
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (\Exception $e) {
            Log::error('Payment Error: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan pada sistem pembayaran'
                ], 500);
            }
            
            return back()->with('error', 'Terjadi kesalahan pada sistem pembayaran');
        }
    }
}