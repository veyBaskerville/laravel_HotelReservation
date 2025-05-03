<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'contact_number',
        'reservation_from',
        'reservation_to',
        'room_type',
        'room_capacity',
        'payment_type',
    ];
}
