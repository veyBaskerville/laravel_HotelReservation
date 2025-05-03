<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Tranquessa Hotel</title>

    <!-- Google Fonts & Bootstrap -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=DM+Serif+Text&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Cormorant Garamond'; }
        body { background-image: url('{{ asset('images/bggg.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed; color: white; }
        .navbar { display: flex; justify-content: space-between; background: #2C261E; padding: 10px 20px; align-items: center; z-index: 1000; }
        .navbar .logo { font-size: 24px; color: white; font-weight: bold; }
        .navbar a { color: white; text-decoration: none; padding: 10px 20px; font-size: 20px; }
        .navbar a:hover { text-decoration: underline; }
        .contact-header { text-align: center; margin-top: 50px; margin-bottom: 30px; }
        .contact-header h1 { font-size: 48px; font-weight: bold; }
        .contact-card { background: rgba(0, 0, 0, 0.5); color: white; border-radius: 10px; padding: 20px; text-align: center; }
        .contact-card h2 { font-size: 24px; margin-bottom: 15px; }
        .contact-card p { font-size: 16px; margin-bottom: 20px; }
        .contact-card a { color: white; text-decoration: none; font-weight: bold; padding: 10px 20px; background: #4A403A; border-radius: 5px; }
        .contact-card a:hover { background: #6D5F57; }
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

    <div class="container">
        <div class="contact-header">
            <h1>Contact Us</h1>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="contact-card">
                    <h2>Speak with Our Reservation Specialist</h2>
                    <p class="fs-5">Let us help you choose the perfect room and package for your stay. Our team is ready to assist with your bookings and special requests.</p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="contact-card">
                    <h2>Guest Services & Support</h2>
                    <p class="fs-5">Our support desk is here 24/7 to ensure your stay is as smooth as possible. Can’t find what you need? We're just a message away.</p>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-md-12">
                <div class="contact-card">
                    <h2>Complete the Enquiry Form</h2>
                    <p class="fs-5">Complete the enquiry form below and we will be in touch shortly.</p>
                    <form method="POST" action="{{ url('/submit-contact') }}" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Preferred contact *</label>
                            <div>
                                <input type="radio" id="phone" name="preferred_contact" value="Phone" required>
                                <label for="phone">Phone</label>
                                <input type="radio" id="email" name="preferred_contact" value="Email" required class="ms-3">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">First Name *</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Last Name *</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contactNumber" class="form-label">Contact Number *</label>
                                <input type="text" class="form-control" id="contactNumber" name="contact_number" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="consent" name="consent" required>
                            <label class="form-check-label" for="consent">I consent to having this website store my submitted information so they can respond to my enquiry.</label>
                        </div>
                        <button type="submit" class="btn btn-outline-light" style="background-color: #6D5F57; color: white;">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
