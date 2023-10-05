<?php

namespace App\Listeners;

use App\Events\LoginHistory;
use App\Models\UserLoginHistore;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreLoginUserHistory
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
    public function handle(LoginHistory $event): void
    {

      $userInfo = $event->user;

      $userHistory = UserLoginHistore::create([

            'user_id' => $userInfo->id,
            'name'    => $userInfo->name,
            'email'   => $userInfo->email,

        ]);

     
    }
}
