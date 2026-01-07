<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Baby Tree</title>

    <!-- CSS -->
    <link rel="stylesheet" href="styleregister.css">
</head>
<body>

<div class="container">
    <!-- LEFT -->
    <div class="left-section">
        <div class="logo-container">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Baby Tree Logo">
            </div>
            <h1 class="brand-name">Baby Tree</h1>
        </div>
    </div>

    <!-- RIGHT -->
<div class="right-section">
    <div class="form-container">
        <h2 class="form-title">Registrasi</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form id="registrationForm" action="{{ route('register.submit') }}" method="POST">
            
            @csrf 

            <div class="form-group">
                <label for="email" class="form-label">Gmail</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-input @error('email') is-invalid @enderror" 
                    placeholder="contoh@gmail.com" 
                    value="{{ old('email') }}" 
                    required 
                >
                @error('email')
                    <span style="color: red; font-size: 0.8em;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    class="form-input @error('username') is-invalid @enderror" 
                    placeholder="Masukkan username" 
                    value="{{ old('username') }}" 
                    required
                >
                @error('username')
                    <span style="color: red; font-size: 0.8em;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input @error('password') is-invalid @enderror" 
                    placeholder="Masukkan password" 
                    required
                >
                @error('password')
                    <span style="color: red; font-size: 0.8em;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>

            <p class="footer-text">
                Daftarkan diri Anda sekarang untuk berkontribusi menanam pohon,
                menjaga bumi tetap hijau, dan mewariskan lingkungan sehat bagi
                generasi mendatang.
            </p>
        </div>
    </div>
</div>

<!-- JS -->
<script src="register.js"></script>
</body>
</html>
