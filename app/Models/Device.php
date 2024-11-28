<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial', 
        'store_code', 
        'store_name', 
        'status',
        'approval_status',
        'counter',
    ];
}
