<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    public $timestamps = true; 
    protected $fillable = ['comment', 'product_id ', 'name', 'user_id', 'status'];
    protected $primaryKey = 'id';
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
