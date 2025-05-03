<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cormorant', serif;
            background: url('{{ asset('images/bggg.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: rgba(52, 50, 50, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(225, 185, 185, 0.2);
            max-width: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="text-center text-light fw-bold">Admin Login</h1>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('admin.login') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label text-light fw-bold fs-5">Username</label>
                <input type="text" name="username" id="username" class="form-control fw-bold" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-light fw-bold fs-5">Password</label>
                <input type="password" name="password" id="password" class="form-control fw-bold" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold">Login</button>
        </form>
    </div>
</body>
</html>
