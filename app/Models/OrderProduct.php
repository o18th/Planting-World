<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    
    public $timestamps=false;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',        
    ];

    // cвязь  "ЗаказПродукт - заказ"
    public function OrderProductOrder() {
        return $this->belongsTo(Order::class,'order_id');
    }

    //  связь "ЗаказПродук - Продукты"
    public function OrderProductProduct() {
        return $this->belongsTo(Plants::class,'product_id');
    }
}
