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
        Adress::create([
            'user_id' => $event->user->id,
            'country' => '',
            'provice' => '',
            'district' => '',
            'local_comunity' => '',
        ]);
    }
}
