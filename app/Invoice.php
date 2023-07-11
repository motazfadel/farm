<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Typeclass;

class Invoice extends Model
{
    // use HasFactory;
    protected $guarded = [];
 
    public function type()
    {
        return $this->hasMany(Typeclass::class, 'invoices_id', 'id');
    }
}
