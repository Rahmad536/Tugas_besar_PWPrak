]<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event-GrowEarth</title>
    
    <link rel="stylesheet" href="{{ asset('styleEvent.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    @include('partials.navbar')

    <header class="event-header">
        <div class="hero-left">
            <div class="textured-text">
                <h1>LINDUNGI<br>HUTAN<br>INDONESIA</h1>
            </div>
        </div>

        <div class="hero-right">
            <img src="{{ asset('images/gambar6.jpg') }}" alt="Forest view">
            <div class="hero-right-content">
                <h2>To Everybody</h2>
                <p>You're invited To Our</p>
            </div>
        </div>
    </header>

    <main class="event-main">
        <section class="invitation-text">
            <p>Kami mengundang Anda mengikuti kampanye “Lindungi Hutan Indonesia” untuk membahas upaya pencegahan pembalakan liar.</p>
        </section>

        <section class="date-time-container">
            <div class="time">09.00</div>
            <div class="separator"></div>
            <div class="date-box">
                <div class="date-number">10</div>
                <div class="month-year">
                    <span>Juli</span>
                    <span>2026</span>
                </div>
            </div>
        </section>

        <section class="details">
            <p>Di Hall GrowEarth</p>
            <p>Registrasi Sekarang Melalui GrowEarth.com</p>
        </section>

        <a href="#" class="btn-join">Gabung</a>
    </main>

    @include('partials.footer')

</body>
</html>