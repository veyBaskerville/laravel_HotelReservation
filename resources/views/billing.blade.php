<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP1: Tranquessa Hotel</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=DM+Serif+Text&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
      * { margin: 0; padding: 0; box-sizing: border-box;  }
        body { 
            background-image: url('{{ asset('images/bggg.jpg') }}');
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            background: #2C261E;
            padding: 10px 20px;
            align-items: center;
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 24px;
            color: white;
            font-family: 'Cormorant Garamond', serif;
            font-weight: bold;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 20px;
            font-family: 'Cormorant Garamond', serif;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container { 
            padding: 20px; 
            max-width: 800px; 
            margin: auto; 
        }
        .shadow-box { 
            padding: 25px; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); 
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px; 
            margin: 20px auto; /* Centers horizontally and adjusts for fixed navbar height */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        h2 { 
            text-align: center; 
            font-family: 'Cormorant Garamond', serif; /* Font for h1 */
            font-size: 40px;
            color: white;
            font-weight: bold; 
        }
        table { 
            width: 100%; 
            max-width: 700px; 
            margin: 0 auto; 
            border-collapse: collapse; 
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            
        }
        table, th, td { 
            border: 1px solid #ddd; 
            
        }

        th, td { 
            padding: 10px; 
            text-align: left; 
            color: white;
            
        }
        th {
            background-color:#C1AA90; 
        }
        .billing-info p { 
            margin-bottom: 15px; }
        .billing-info strong { 
            font-weight: bold; }
        .discount { 
            text-align: center; 
            margin-top: 20px; 
            font-size: 18px; 
            color: white; 
            font-family: 'Cormorant Garamond', serif; 
            font-style: italic;
        }

        /* Button Styling */
        .button-container { text-align: center; margin-top: 20px; }
        .button-container a {
            display: inline-block;
            padding: 12px 30px;
            font-size: 20px;
            color: white;
            background-color: #C1AA90;
            border-radius: 5px;
            text-decoration: none;
            margin: 0 10px;
            transition: background-color 0.3s ease;
            font-family: 'Cormorant Garamond', serif; /* Apply the desired font */
        }
        .button-container a:hover {
            background-color: #AF8F6F;
        }
        .button-container .back-btn {
            background-color: #C1AA90;
        }
        .button-container .back-btn:hover {
            background-color: #AF8F6F;
        }
</style>

<div class="navbar">
    <div class="logo">Tranquessa Admin</div>
    <div class="nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/company-profile') }}">Company's Profile</a>
            <a href="{{ url('/reservation') }}">Reservation</a>
            <a href="{{ url('/contact') }}">Contact</a>
        <a href="{{ url('/admin/login') }}" class="btn btn-outline-light">Admin</a>
    </div>
</div>

<div class="container mt-2">
    <h2>Billing Information</h2>
    <div class="discount">
        <p class="fs-5">Enjoy our 10% discount for 3-5 days of reservation or</p>
        <p class="fs-5">Enjoy our 15% discount for 6 days or above of reservation</p>
    </div>

 <div class="shadow-box">
    <table>
        <tr><th colspan="3">Reservation Information</th></tr>
        <tr>
            <td><strong>Customer Name:</strong></td>
            <td colspan="2"><strong>{{ $reservation->name }}</strong></td>
        </tr>
        <tr>
            <td><strong>Contact Number:</strong></td>
            <td colspan="2"><strong>{{ $reservation->contact_number }}</strong></td>
        </tr>
        <tr>
            <td><strong>Date Reserved:</strong></td>
            <td><strong>{{ \Carbon\Carbon::parse($reservation->reservation_from)->format('F j, Y') }}</strong></td>
            <td><strong>to {{ \Carbon\Carbon::parse($reservation->reservation_to)->format('F j, Y') }}</strong></td>
        </tr>
        <tr>
            <td><strong>Room Type:</strong></td>
            <td colspan="2"><strong>{{ $reservation->room_type }}</strong></td>
        </tr>
        <tr>
            <td><strong>Room Capacity:</strong></td>
            <td colspan="2"><strong>{{ $reservation->room_capacity }}</strong></td>
        </tr>
        <tr>
            <td><strong>Payment Type:</strong></td>
            <td colspan="2"><strong>{{ $reservation->payment_type }}</strong></td>
        </tr>
    </table>

    <br>

    <table>
        <tr><th colspan="2">Billing Breakdown</th></tr>
        <tr>
            <td>Number of Days:</td>
            <td>{{ $dateDiff }}</td>
        </tr>
        <tr>
            <td>Room Rate per Day:</td>
            <td>₱{{ number_format($roomRate, 2) }}</td>
        </tr>
        <tr>
            <td>Subtotal:</td>
            <td>₱{{ number_format($subTotal, 2) }}</td>
        </tr>
        <tr>
            <td>Discount:</td>
            <td>- ₱{{ number_format($discount, 2) }}</td>
        </tr>
        <tr>
            <td>Additional Charges ({{ $reservation->payment_type }}):</td>
            <td>+ ₱{{ number_format($additionalCharge, 2) }}</td>
        </tr>
        <tr>
            <th>Total Bill:</th>
            <th>₱{{ number_format($totalBill, 2) }}</th>
        </tr>
    </table>

    <div class="button-container mt-4">
        <a href="{{ url('/reservation') }}" class="back-btn">Back to Reservation</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
