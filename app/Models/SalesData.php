<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesData extends Model
{
    //Set Custom Primary Key for SalesData Model
    use HasFactory;

    protected $primaryKey = 'sales_id';    
}
