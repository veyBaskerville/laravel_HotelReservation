{{-- resources/views/company-profile.blade.php --}}
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
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Cormorant Garamond'; }
        body {
            background-image: url("{{ asset('images/bggg.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
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
            font-weight: bold;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 20px;
        }
        .navbar a:hover {
            text-decoration: underline;
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
            <a href="{{ route('admin.login.form') }}" class="btn btn-outline-light">Admin</a>
    </div>
</div>

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/h1.jpg') }}" class="d-block w-100" alt="..." style="height: 870px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/h2.jpg') }}" class="d-block w-100" alt="..." style="height: 870px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/h3.jpg') }}" class="d-block w-100" alt="..." style="height: 870px; object-fit: cover;">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<h1 class="mt-5 text-center display-5">Welcome to Tranquessa Hotel</h1>
<p class="text-center mx-5 fs-5">
    Tranquessa Hotel is your ultimate destination for luxury and comfort...
</p>

<h2 class="mt-5 mb-4 text-center">Here at Tranquessa, we offer a variety of services.</h2>
<div class="row row-cols-1 row-cols-md-2 g-4 mx-5 mb-5">
    <div class="col">
        <div class="card">
            <img src="{{ asset('images/roomservice.jpg') }}" class="card-img-top" alt="..." style="height: 400px; object-fit: cover;">
            <div class="card-body text-dark">
                <h5 class="card-title text-center">Room Service</h5>
                <p class="card-text text-center">Enjoy gourmet meals delivered straight to your room, available 24/7...</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <img src="{{ asset('images/housekeeping.jpeg') }}" class="card-img-top" alt="..." style="height: 400px; object-fit: cover;">
            <div class="card-body text-dark">
                <h5 class="card-title text-center">Housekeeping</h5>
                <p class="card-text text-center">Our housekeeping team ensures your room is spotless and refreshed daily...</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <img src="{{ asset('images/drycleaning.jpg') }}" class="card-img-top" alt="..." style="height: 400px; object-fit: cover;">
            <div class="card-body text-dark">
                <h5 class="card-title text-center">Laundry and Dry Cleaning</h5>
                <p class="card-text text-center">We offer professional laundry and dry-cleaning services to keep your wardrobe fresh...</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <img src="{{ asset('images/amenities.jpg') }}" class="card-img-top" alt="..." style="height: 400px; object-fit: cover;">
            <div class="card-body text-dark">
                <h5 class="card-title text-center">In-room Amenities</h5>
                <p class="card-text text-center">From plush bedding to high-speed Wi-Fi, our in-room amenities are designed to provide comfort...</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
