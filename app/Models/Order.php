<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_amount',
        'name',
        'address',
        'phone',
        'note',
        'email',
        'order_date'
    ];
    public function customer()
    {
       
    }
}
