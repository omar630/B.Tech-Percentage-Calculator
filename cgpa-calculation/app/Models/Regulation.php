<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regulation extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->hasMany(User::class, 'regulation_id');
    }

    public function subject()
    {
        return $this->hasMany(Subject::class);
    }
}
