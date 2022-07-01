<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    public $timestamps = true; 
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'feedback', 
        'order_id', 
        'status', 
        'issue',
    ];
    protected $primaryKey = 'id';
}
