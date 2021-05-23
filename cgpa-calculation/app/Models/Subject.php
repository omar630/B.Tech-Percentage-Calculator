<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['regulation_id', 'year', 'sem', 'name', 'credit', 'branch_id'];

    public function branch()
    {
        return $this->belongsTo(Branche::class, 'branch_id');
    }

    public function regulation()
    {
        return $this->belongsTo(Regulation::class);
    }

    public function subjectType()
    {
        return $this->belongsTo(SubjectType::class);
    }
}
