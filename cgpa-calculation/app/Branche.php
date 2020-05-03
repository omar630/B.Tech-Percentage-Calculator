<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    public function getSubjects(){
    	return $this->hasMany('App\Subject','branch_id');
    }
}