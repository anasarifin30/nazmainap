<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\UpdateBookingStatus::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Jalankan setiap 5 menit untuk update status real-time
        $schedule->command('booking:update-status')
                 ->everyFiveMinutes()
                 ->withoutOverlapping()
                 ->runInBackground();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}