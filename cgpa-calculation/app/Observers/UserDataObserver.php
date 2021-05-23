<?php

namespace App\Observers;

use App\Models\user_data;
use Stevebauman\Location\Facades\Location;

class UserDataObserver
{

    public function creating(user_data $user_data)
    {
        if ($position = Location::get()) {

            $user_data->location = $position;
            \Log::debug('location');
            \Log::debug(json_encode($position));
        } else {
            \Log::debug('no location');
        }
    }
    /**
     * Handle the user_data "created" event.
     *
     * @param  \App\Models\user_data  $user_data
     * @return void
     */
    public function created(user_data $user_data)
    {
        //
    }

    /**
     * Handle the user_data "updated" event.
     *
     * @param  \App\Models\user_data  $user_data
     * @return void
     */
    public function updated(user_data $user_data)
    {
        //
    }

    /**
     * Handle the user_data "deleted" event.
     *
     * @param  \App\Models\user_data  $user_data
     * @return void
     */
    public function deleted(user_data $user_data)
    {
        //
    }

    /**
     * Handle the user_data "restored" event.
     *
     * @param  \App\Models\user_data  $user_data
     * @return void
     */
    public function restored(user_data $user_data)
    {
        //
    }

    /**
     * Handle the user_data "force deleted" event.
     *
     * @param  \App\Models\user_data  $user_data
     * @return void
     */
    public function forceDeleted(user_data $user_data)
    {
        //
    }
}
