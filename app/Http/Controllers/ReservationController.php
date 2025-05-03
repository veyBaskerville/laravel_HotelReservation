<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function create()
    {
        return view('reservation');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'room_type' => 'required|string',
            'room_capacity' => 'required|string',
            'payment_type' => 'required|string',
        ]);

        $rates = [
            'Single' => ['Regular' => 100, 'De Luxe' => 300, 'Suite' => 500],
            'Double' => ['Regular' => 200, 'De Luxe' => 500, 'Suite' => 800],
            'Family' => ['Regular' => 500, 'De Luxe' => 750, 'Suite' => 1000],
        ];

        $paymentCharges = ['Cash' => 0, 'Check' => 0.05, 'Credit Card' => 0.10];

        $dateDiff = (strtotime($request->to_date) - strtotime($request->from_date)) / (60 * 60 * 24);

        $roomRate = $rates[$request->room_capacity][$request->room_type] ?? 0;
        $subTotal = $roomRate * $dateDiff;

        $discount = 0;
        if ($dateDiff >= 3 && $dateDiff < 6) {
            $discount = $subTotal * 0.10;
        } elseif ($dateDiff >= 6) {
            $discount = $subTotal * 0.15;
        }

        $additionalCharge = $subTotal * ($paymentCharges[$request->payment_type] ?? 0);
        $totalBill = $subTotal - $discount + $additionalCharge;

        // Save reservation and capture the model
        $reservation = Reservation::create([
            'name' => $request->customer_name,
            'contact_number' => $request->contact_number,
            'reservation_from' => $request->from_date,
            'reservation_to' => $request->to_date,
            'room_type' => $request->room_type,
            'room_capacity' => $request->room_capacity,
            'payment_type' => $request->payment_type,
        ]);

        return redirect()->route('billing', ['id' => $reservation->id]);
    }

    public function billing($id)
    {
        $reservation = Reservation::findOrFail($id);
    
        $rates = [
            'Single' => ['Regular' => 100, 'De Luxe' => 300, 'Suite' => 500],
            'Double' => ['Regular' => 200, 'De Luxe' => 500, 'Suite' => 800],
            'Family' => ['Regular' => 500, 'De Luxe' => 750, 'Suite' => 1000],
        ];
    
        $paymentCharges = ['Cash' => 0, 'Check' => 0.05, 'Credit Card' => 0.10];
    
        $dateDiff = (strtotime($reservation->reservation_to) - strtotime($reservation->reservation_from)) / (60 * 60 * 24);
    
        $roomRate = $rates[$reservation->room_capacity][$reservation->room_type] ?? 0;
        $subTotal = $roomRate * $dateDiff;
    
        $discount = 0;
        if ($dateDiff >= 3 && $dateDiff < 6) {
            $discount = $subTotal * 0.10;
        } elseif ($dateDiff >= 6) {
            $discount = $subTotal * 0.15;
        }
    
        $additionalCharge = $subTotal * ($paymentCharges[$reservation->payment_type] ?? 0);
        $totalBill = $subTotal - $discount + $additionalCharge;
    
        // Passing reservation data to the view
        return view('billing', compact(
            'reservation',
            'dateDiff',
            'roomRate',
            'subTotal',
            'discount',
            'additionalCharge',
            'totalBill'
        ));
    }
    
    
}
