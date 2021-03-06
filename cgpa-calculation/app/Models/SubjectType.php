<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectType extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function subject()
    {
        return $this->hasMany(Subject::class);
    }
}
