<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarksData extends Model
{
    protected $fillable = ['subject_id', 'gradepoint', 'user_id'];
}
