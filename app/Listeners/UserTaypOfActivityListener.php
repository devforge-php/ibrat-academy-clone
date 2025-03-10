<?php

namespace App\Listeners;

use App\Events\AuthEvent;
use App\Models\TaypOfActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserTaypOfActivityListener
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
        // Foydalanuvchining faoliyat turi mavjudligini tekshiramiz
        $existingActivity = TaypOfActivity::where('user_id', $event->user->id)->first();

        if (!$existingActivity) {
            TaypOfActivity::create([
                'user_id' => $event->user->id,
                'type_of_activity' => '',
                'province' => '',
                'district' => '',
                'organization_name' => '',
            ]);
        }
    }
}
