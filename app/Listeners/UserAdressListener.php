<?php

namespace App\Listeners;

use App\Events\AuthEvent;
use App\Models\Adress;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserAdressListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AuthEvent $event): void
    {
        // Foydalanuvchi manzili mavjudligini tekshiramiz
        $existingAddress = Adress::where('user_id', $event->user->id)->first();

        if (!$existingAddress) {
            Adress::create([
                'user_id' => $event->user->id,
                'country' => '',
                'provice' => '',
                'district' => '',
                'local_comunity' => '',
            ]);
        }
    }
}
