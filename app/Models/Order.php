<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'status_id',
        'note',
    ];
    
    //  связь "заказы - пользователь"
    public function OrderUser() {
       return $this->belongsTo(User::class, 'user_id');
    }
    
    // cвязь  "заказ - статус"
    public function OrderStatus() {
        return $this->belongsTo(Status::class,'status_id');
    }

    // cвязь  "заказ - ЗаказПродукт"
    public function OrderOrderProduct() {
        return $this->hasMany(OrderProduct::class,'order_id');
    }
}
