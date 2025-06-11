<?php

class Kernel
{
    protected $middlewareGroups = [
        'web' => [
            // ... existing middleware ...
            \App\Http\Middleware\UpdateBookingStatus::class,
        ],
        // ... other middleware groups ...
    ];
}