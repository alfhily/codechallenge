<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Add the fields you want to allow for mass assignment
    protected $fillable = [
        'name', 
        'class', 
        'level', 
        'parent_contact'
    ];
}
