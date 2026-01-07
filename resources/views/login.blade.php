<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Selamat Datang</title>

    <!-- LINK CSS -->
    <link rel="stylesheet" href="stylelogin.css">

    <!-- FONT POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <!-- LEFT -->
    <div class="left-section">
        <div class="logo-container">
            <div class="logo-placeholder">
                <img src="images/welocome.png" alt="Selamat Datang">
            </div>
        </div>

        <h2 class="sign-in-title">Sign-in</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Tampilkan error jika ada -->
            @if ($errors->any())
                <div style="background: #fee; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    @foreach ($errors->all() as $error)
                        <p style="color: red; margin: 5px 0;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Tampilkan success message -->
            @if (session('success'))
                <div style="background: #efe; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <p style="color: green; margin: 5px 0;">{{ session('success') }}</p>
                </div>
            @endif

            <div class="input-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="login-btn">Login</button>

            <p class="register-text">
                Jika kamu belum punya akun, 
                <a href="{{ route('register.form') }}">registrasi</a> dulu dong.
            </p>
        </form>

    </div>

    <!-- RIGHT -->
    <div class="right-section">
        <div class="image-placeholder">
            <img src="images/download.jpg" alt="Community Garden">
        </div>
    </div>
</div>

</body>
</html>