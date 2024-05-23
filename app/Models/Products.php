<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id'; // Default, bisa dihilangkan karena sudah default

    public function canteen()
    {
        return $this->belongsTo(Canteens::class);
    }


    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'product_id', 'id');
    }
}
