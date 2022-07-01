<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
    	'coupon_name', 
        'coupon_code', 
        'coupon_quantity', 
        'coupon_discount', 
        'coupon_condition', 
        'coupon_start', 
        'coupon_end',
        'user_id',
        'coupon_min',
    ];
    protected $primaryKey = 'coupon_id';
    protected $table = 'coupon';
}
