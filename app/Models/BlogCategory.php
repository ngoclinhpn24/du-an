<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table = 'blogcategory';
    public $timestamps = false; 
    protected $fillable = ['blogcategory_name', 'blogcategory_status'];
    protected $primaryKey = 'blogcategory_id';
}
