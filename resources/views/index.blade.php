<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP1: Tranquessa Hotel</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body {
            background-image: url('{{ asset('images/bggg.jpg') }}');
            background-size: cover;
            background-position: center;
            color: white;
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

        .home-container {
            text-align: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .home-container button {
            padding: 15px 30px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;
            background: #6D4C41;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
        }

        h1, p {
            font-family: 'Cormorant Garamond', serif;
        }

        .card-title {
            color: black;
            font-family: 'Cormorant Garamond', serif;
            font-size: 30px;
        }

        .card-text {
            color: black;
            font-size: 20px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
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

    <div class="container">
        <div class="home-container pb-5">
            <h1 class="mb-4 display-3 fw-bold">Welcome to Our Hotel</h1>
            <p class="fs-5">Escape the ordinary and indulge in a world of comfort, elegance, and tranquility.<br> 
                Whether you're seeking a peaceful retreat or a lavish getaway, your perfect stay begins here.<br> 
                Book your stay now and experience true relaxation.</p>
            <button onclick="window.location.href='{{ url('/reservation') }}'">Make a Reservation</button>

            <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('images/suite.jpg') }}" class="card-img-top" alt="Suite Room">
                        <div class="card-body">
                            <h5 class="card-title">Suite Room</h5>
                            <p class="card-text">The best experience for luxury in our spacious suite.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('images/deluxe.jpg') }}" class="card-img-top" alt="De Luxe Room">
                        <div class="card-body">
                            <h5 class="card-title">De Luxe Room</h5>
                            <p class="card-text">Enjoy a comfortable stay with premium amenities.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('images/regular.jpg') }}" class="card-img-top" alt="Regular Room">
                        <div class="card-body">
                            <h5 class="card-title">Regular Room</h5>
                            <p class="card-text">Experience a cozy and affordable option for your stay.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
