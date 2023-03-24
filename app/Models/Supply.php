<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'stock_id',
        'quantity',
        'price',
    ];   
    
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
