<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin'; // Ensure this matches your database table name
    protected $fillable = ['username', 'password']; // Allow these fields to be mass assigned

    // Mutator for password field
}
