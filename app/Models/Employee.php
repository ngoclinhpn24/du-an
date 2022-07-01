<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    public $timestamps = false; 
    protected $fillable = [
        'employee_name',
        'employee_address',
        'employee_phone',
        'user_address',
        'employee_job',
        'employee_email'
    ];

}
