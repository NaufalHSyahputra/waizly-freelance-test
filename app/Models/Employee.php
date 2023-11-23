<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //Set Custom Primary key to Employee Model
    protected $primaryKey = 'employee_id';
    use HasFactory;
    
}
