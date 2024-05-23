<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canteens extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Products::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
