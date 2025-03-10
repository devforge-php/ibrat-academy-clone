<?php

namespace App\Listeners;

use App\Events\AuthEvent;
use App\Models\Profile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserProfileCreated
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
        // Foydalanuvchi profili allaqachon mavjudligini tekshiramiz
        $existingProfile = Profile::where('user_id', $event->user->id)->first();

        if (!$existingProfile) {
            Profile::create([
                'user_id' => $event->user->id,
                'name' => '',
                'last_name' => '',
                'age' => '',
                'gender' => '',
            ]);
        }
    }
}
