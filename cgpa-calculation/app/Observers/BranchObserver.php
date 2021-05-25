<?php

namespace App\Observers;

use App\Models\Branche;
use App\Models\Subject;

class BranchObserver
{
    /**
     * Handle the Branche "created" event.
     *
     * @param  \App\Models\Branche  $branche
     * @return void
     */
    public function created(Branche $branche)
    {
        //
    }

    /**
     * Handle the Branche "updated" event.
     *
     * @param  \App\Models\Branche  $branche
     * @return void
     */
    public function updated(Branche $branche)
    {
        //
    }

    /**
     * Handle the Branche "deleted" event.
     *
     * @param  \App\Models\Branche  $branche
     * @return void
     */
    public function deleted(Branche $branche)
    {
        $users = $branche->user;
        foreach ($users as $user) {
            $user->branch_id = null;
            $user->regulation_id = null;
            $user->save();
        }
        $subjects = $branche->subject;
        if ($subjects) {
            Subject::whereIn('id', $subjects->pluck('id')->toArray())->delete();
        }
    }

    /**
     * Handle the Branche "restored" event.
     *
     * @param  \App\Models\Branche  $branche
     * @return void
     */
    public function restored(Branche $branche)
    {
        //
    }

    /**
     * Handle the Branche "force deleted" event.
     *
     * @param  \App\Models\Branche  $branche
     * @return void
     */
    public function forceDeleted(Branche $branche)
    {
        //
    }
}
