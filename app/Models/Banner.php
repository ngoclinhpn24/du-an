<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banner';
    public $timestamps = false; 
    protected $fillable = ['banner_name', 'banner_image','banner_status','banner_desc'];
    protected $primaryKey = 'id';

}
