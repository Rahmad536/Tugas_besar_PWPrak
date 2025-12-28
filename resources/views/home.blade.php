<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styleHome.css') }}">

    <title>laravel-Web-GrowEarth</title>

</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">GrowEarth</div>

            <ul class="nav-menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">Event</a></li>
                <li><a href="#">Donasi</a></li>
                <li><a href="#">Tentang</a></li>
            </ul>
        </div>
    </nav>
        <div class="Gambar-home">
            <img src="{{ asset('images/gambarHome.jpg') }}" alt="laravel-web-growearth">
        </div>
        <div class="hero-text">
            <h1>We take care of your<br>garden & tree</h1>
            <p>
            Garden Tree has blossomed into a leading company dedicated
            to providing innovative solution for gardening
            </p>
        </div>

</body>
</html>