<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarksData extends Model
{
    use SoftDeletes;


    protected $fillable = ['subject_id', 'gradepoint', 'user_id'];
}
