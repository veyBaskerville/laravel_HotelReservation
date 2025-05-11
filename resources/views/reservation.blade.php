<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP1: Tranquessa Hotel</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { 
            background-image: url("{{ asset('images/bggg.jpg') }}");
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            color: white;
            padding-top: 70px; /* Add this line to account for the navbar height */
        }

        /* Navbar styling */
        .navbar { 
            position: fixed; 
            top: 0; left: 0; right: 0; 
            background-color: #2C261E; 
            padding: 10px 20px;
            display: flex; 
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }
        .navbar .logo { 
            color: white; 
            font-size: 24px; 
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

        /* Main Content Container */
        .container {
            background: rgba(0, 0, 0, 0.5);
            padding: 40px;
            width: 80%;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(68, 67, 63, 0.5);
            margin: 100px auto; /* Centers horizontally and adjusts for fixed navbar height */
            margin-top: 100px; /* Adjusted to create proper spacing */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 36px;
            text-align: center;
        }

        .datetime {
            font-family: 'Times New Roman', serif;
            font-size: 16px;
            text-align: right;
        }

        .form-container { 
            display: flex; 
            flex-direction: column; 
            gap: 20px; 
            
        }
        .form-container label { 
            font-size: 18px;
            margin-bottom: 10px; 
            font-family: 'Times New Roman', Times, serif;
        }
        .form-container input[type="text"], .form-container input[type="date"] { 
            padding: 10px; 
            font-size: 14px; 
            border-radius: 5px; 
            border: 1px solid #ccc; 
            width: 100%; 
            margin-bottom: 25px;
        }
        .form-container .radio-group { 
            display: flex; 
            gap: 30px; 
            margin-bottom: 20px; 
        }
        .form-container .radio-group label { 
            white-space: nowrap; 
        }
        .form-container .buttons { 
            display: flex; 
            justify-content: space-around; 
            margin-top: 50px; 
        }
        .form-container .buttons button { 
            padding: 12px 25px; 
            font-size: 16px; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: 0.3s; 
        }
        .form-container .buttons button[type="submit"] { 
            background-color: #C1AA90; 
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px; 


        }
        .form-container .buttons button[type="reset"] { 
            background-color: #C1AA90; 
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px; 


        }
        .form-container .buttons button:hover { 
            opacity: 0.8; 
        }

        .radio-group {
            display: flex;
            justify-content: center;
            gap: 100px;
            align-items: center;
        }

        .radio-group input {
            margin: 0 20px;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">Tranquessa</div>
        <div class="nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/company-profile') }}">Company's Profile</a>
            <a href="{{ url('/reservation') }}">Reservation</a>
            <a href="{{ url('/contact') }}">Contact</a>
            <a href="{{ url('/admin-login') }}" class="btn btn-outline-light">Admin</a>
        </div>
    </div>

    <div class="container mt-5">
        <h2>Hotel Reservation</h2>
        <div class="datetime">{{ now('Asia/Manila')->format('F j, Y g:i:s a') }}</div>

        <div class="form-container">
            <form id="reservationForm" method="POST" action="{{ route('reservation.store') }}" onsubmit="return validateForm()">
                @csrf
                <label for="customer_name">Customer Name:</label>
                <input type="text" name="customer_name" required>
                <br>
                <label for="contact_number">Contact Number:</label>
                <input type="text" name="contact_number" required>
                <br>
                <label for="from_date">From Date:</label>
                <input type="date" name="from_date" required>
                <br>
                <label for="to_date">To Date:</label>
                <input type="date" name="to_date" required>
                <br>
                <label>Room Type:</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="room_type" value="Suite">Suite
                    </label>
                    <label>
                        <input type="radio" name="room_type" value="De Luxe">De Luxe
                    </label>
                    <label>
                        <input type="radio" name="room_type" value="Regular">Regular
                    </label>
                </div>

                <label>Room Capacity:</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="room_capacity" value="Family">Family
                    </label>
                    <label>
                        <input type="radio" name="room_capacity" value="Double">Double
                    </label>
                    <label>
                        <input type="radio" name="room_capacity" value="Single">Single
                    </label>
                </div>

                <label>Payment Type:</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="payment_type" value="Cash">Cash
                    </label>
                    <label>
                        <input type="radio" name="payment_type" value="Check">Cheque
                    </label>
                    <label>
                        <input type="radio" name="payment_type" value="Credit Card">Credit Card
                    </label>
                </div>

                <div class="buttons">
                    <button type="submit">Submit Reservation</button>
                    <button type="reset">Clear Entry</button>
                </div>
            </form>

            <div id="error-message" class="error-message"></div>
        </div>
    </div>

    <script>
        function validateForm() {
            var roomType = document.querySelector('input[name="room_type"]:checked');
            var roomCapacity = document.querySelector('input[name="room_capacity"]:checked');
            var paymentType = document.querySelector('input[name="payment_type"]:checked');
            var errorMessage = '';

            if (!roomType) {
                errorMessage += 'No selected room type. <br>';
            }
            if (!roomCapacity) {
                errorMessage += 'No selected room capacity. <br>';
            }
            if (!paymentType) {
                errorMessage += 'No selected type of payment. <br>';
            }

            if (errorMessage) {
                document.getElementById('error-message').innerHTML = errorMessage;
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
</body>
</html>
