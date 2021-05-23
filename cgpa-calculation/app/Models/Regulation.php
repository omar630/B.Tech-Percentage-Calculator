<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regulation extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
