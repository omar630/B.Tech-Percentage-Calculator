<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branche extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'branch',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'branch_id');
    }
}
