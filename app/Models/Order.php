<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OrderDetail;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    public $timestamps = false; 
    protected $fillable = [
        'order_total', 
        'order_status', 
        'coupon', 
        'day', 
        'feeship', 
        'shipper_name', 
        'shipper_phone', 
        'order_code',
        'payment_id',
        'shipping_id',
        'user_id'
    ];
    protected $primaryKey = 'order_id';
    public function orderDetail(){
        return $this->hasOne(OrderDetail::class,'order_id');
    }

}
