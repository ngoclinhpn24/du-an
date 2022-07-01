<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    public $timestamps = true; 
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 
        'content', 
        'images', 
        'status', 
        'product', 
        'summary', 
        'view',
        'blogcategory_id',
        'user_id'
    ];
}
