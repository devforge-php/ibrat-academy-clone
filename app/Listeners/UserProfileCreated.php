<?php

namespace App\Listeners;

use App\Events\AuthEvent;
use App\Jobs\ProfileCreatedJobs;
use App\Models\Profile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

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
       Profile::create([
        'user_id' => $event->user->id,
        'name' => '',
        'last_name' => '',
        'age' => '',
        'gender' => '',
       ]);
    }
}
