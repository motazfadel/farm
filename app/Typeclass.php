<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeclass extends Model
{
    // use HasFactory;
    protected $guarded = [];
    public function Invoice()
    {
        return $this->hasMany(Invoice::class,'id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

}
