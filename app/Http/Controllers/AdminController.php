<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        // You can protect the dashboard routes here if needed
        // $this->middleware('auth:admin')->except(['showLoginForm', 'login']);
    }

    public function showLoginForm()
    {
        try {
            return view('Admin.admin_login');
        } catch (\Exception $e) {
            dd($e->getMessage()); // This will display the error message
        }
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $admin = Admin::where('username', $credentials['username'])->first();
        
        if (!$admin) {
            return back()->with('error', 'User not found');
        }
        
        // Get detailed debug info while allowing login
        $enteredPassword = $credentials['password'];
        $dbPassword = $admin->password;
        
        // Try various comparison methods
        $exactMatch = ($enteredPassword === $dbPassword);
        $looseMatch = ($enteredPassword == $dbPassword);
        $castMatch = ((string)$enteredPassword === (string)$dbPassword);
        $trimMatch = (trim($enteredPassword) === trim($dbPassword));
        
        // Check if at least one comparison method worked
        if ($exactMatch || $looseMatch || $castMatch || $trimMatch) {
            // Store debug info for reference
            $debugInfo = [
                'method_worked' => [
                    'exactMatch' => $exactMatch,
                    'looseMatch' => $looseMatch,
                    'castMatch' => $castMatch,
                    'trimMatch' => $trimMatch
                ],
                'entered' => $enteredPassword,
                'database' => $dbPassword,
                'entered_length' => strlen($enteredPassword),
                'db_length' => strlen($dbPassword)
            ];
            
            // Store the session variable
            Session::put('admin_logged_in', true);
            Session::put('login_debug', $debugInfo);
            
            // Redirect to the admin dashboard
            return redirect()->route('admin.dashboard');
        }
        
        // If all comparison methods failed, return with error
        return back()->with('error', 
            "Login failed. Detailed comparison: " .
            "Exact: " . ($exactMatch ? 'Passed' : 'Failed') . ", " .
            "Loose: " . ($looseMatch ? 'Passed' : 'Failed') . ", " .
            "Cast: " . ($castMatch ? 'Passed' : 'Failed') . ", " .
            "Trim: " . ($trimMatch ? 'Passed' : 'Failed') . ", " .
            "Entered: '$enteredPassword' (" . strlen($enteredPassword) . "), " .
            "DB: '$dbPassword' (" . strlen($dbPassword) . ")"
        );
    }

    // Admin Dashboard
    public function dashboard()
    {
        // Ensure that only logged-in admins can access this route
        if (!Session::get('admin_logged_in')) {
            return redirect()->route('admin.login.form');
        }
        $reservations = Reservation::all();  // Fetch all reservations
    
        return view('Admin.dashboard', compact('reservations')); // Pass 'reservations' to the view
    }
    
    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect()->route('admin.login.form');
    }

    // Fixed Add Reservation Method - Now with proper validation and response
    public function addReservation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'reservation_from' => 'required|date',
            'reservation_to' => 'required|date|after_or_equal:reservation_from',
            'room_type' => 'required|string|in:Suite,De Luxe,Regular',
            'room_capacity' => 'required|string|in:Family,Double,Single',
            'payment_type' => 'required|string|in:Cash,Cheque,Credit Card',
        ]);
    
        try {
            Reservation::create($request->only([
                'name',
                'contact_number',
                'reservation_from',
                'reservation_to',
                'room_type',
                'room_capacity',
                'payment_type',
            ]));
    
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Reservation added successfully',
                ]);
            }
    
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Reservation added successfully');
        } catch (\Throwable $e) {
            \Log::error('Reservation Add Failed: ' . $e->getMessage());
    
            $errorMessage = 'Failed to add reservation: ' . $e->getMessage();
    
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                ]);
            }
    
            return redirect()
                ->route('admin.dashboard')
                ->with('error', $errorMessage);
        }
    }
    
    
    // Fixed Edit Reservation Method - Now with proper validation and response
    public function editReservation(Request $request)
    {
        try {
            // Validate the request data
            $validated = $request->validate([
                'id' => 'required|exists:reservations,id',
                'name' => 'required|string|max:255',
                'contact_number' => 'required|string|max:20',
                'reservation_from' => 'required|date',
                'reservation_to' => 'required|date|after_or_equal:reservation_from',
                'room_type' => 'required|string|in:Suite,De Luxe,Regular',
                'room_capacity' => 'required|string|in:Family,Double,Single',
                'payment_type' => 'required|string|in:Cash,Cheque,Credit Card',
            ]);
            
            // Find and update the reservation
            $reservation = Reservation::findOrFail($request->id);
            $reservation->name = $request->name;
            $reservation->contact_number = $request->contact_number;
            $reservation->reservation_from = $request->reservation_from;
            $reservation->reservation_to = $request->reservation_to;
            $reservation->room_type = $request->room_type;
            $reservation->room_capacity = $request->room_capacity;
            $reservation->payment_type = $request->payment_type;
            $reservation->save();
            
            // Check if it's an AJAX request
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Reservation updated successfully']);
            }
    
            // Redirect if it's not an AJAX request
            return redirect()->route('admin.dashboard')->with('success', 'Reservation updated successfully');
            
        } catch (\Exception $e) {
            // Check if it's an AJAX request
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to update reservation: ' . $e->getMessage()]);
            }
    
            // Redirect if it's not an AJAX request
            return redirect()->route('admin.dashboard')->with('error', 'Failed to update reservation: ' . $e->getMessage());
        }
    }
    
    
    // New Delete Reservation Method
    public function deleteReservation(Request $request, $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();
            
            // Check if it's an AJAX request
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Reservation deleted successfully']);
            }
            
            return redirect()->route('admin.dashboard')->with('success', 'Reservation deleted successfully');
        } catch (\Exception $e) {
            // Check if it's an AJAX request
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to delete reservation: ' . $e->getMessage()]);
            }
            
            return redirect()->route('admin.dashboard')->with('error', 'Failed to delete reservation: ' . $e->getMessage());
        }
    }
    
    // Method to get a specific reservation (useful for AJAX requests)
    public function getReservation($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            return response()->json(['success' => true, 'data' => $reservation]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Reservation not found']);
        }
    }
}