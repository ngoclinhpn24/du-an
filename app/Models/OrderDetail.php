<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    public $timestamps = false; 
    protected $primaryKey = 'order_details_id';
    protected $fillable = [
        'product_name',
        'product_price', 
        'product_quantity',
        'order_id',
        'product_id'
    ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
