<?php

namespace App\Observers;

use App\Models\Regulation;
use App\Models\Subject;

class RegulationObserver
{
    /**
     * Handle the Regulation "created" event.
     *
     * @param  \App\Models\Regulation  $regulation
     * @return void
     */
    public function created(Regulation $regulation)
    {
        //
    }

    /**
     * Handle the Regulation "updated" event.
     *
     * @param  \App\Models\Regulation  $regulation
     * @return void
     */
    public function updated(Regulation $regulation)
    {
        //
    }

    /**
     * Handle the Regulation "deleted" event.
     *
     * @param  \App\Models\Regulation  $regulation
     * @return void
     */
    public function deleted(Regulation $regulation)
    {
        $users = $regulation->user;
        foreach ($users as $user) {
            $user->branch_id = null;
            $user->regulation_id = null;
            $user->save();
        }
        $subjects = $regulation->subject;
        if ($subjects) {
            Subject::whereIn('id', $subjects->pluck('id')->toArray())->delete();
        }
    }

    /**
     * Handle the Regulation "restored" event.
     *
     * @param  \App\Models\Regulation  $regulation
     * @return void
     */
    public function restored(Regulation $regulation)
    {
    }

    /**
     * Handle the Regulation "force deleted" event.
     *
     * @param  \App\Models\Regulation  $regulation
     * @return void
     */
    public function forceDeleted(Regulation $regulation)
    {
        //
    }
}
