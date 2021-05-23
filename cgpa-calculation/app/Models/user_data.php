<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class user_data extends Model
{

    use SoftDeletes;

    protected $casts = [
        'location' => 'array',
    ];

    public function regulation()
    {
        return $this->belongsTo(Regulation::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branche::class, 'branch_id');
    }

    public function setLocationAttribute($value)
    {
        $this->attributes['location'] = json_encode($value);
    }
}
