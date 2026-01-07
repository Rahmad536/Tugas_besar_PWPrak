<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-GrowErath</title>

    <link rel="stylesheet" href="{{ asset('styleHome.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    @include('partials.navbar')

    <div class="Gambar-home">
        <img src="{{ asset('images/gambarHome.jpg') }}" alt="laravel-web-growearth">
    </div>

    <div class="hero-text">
        <h1>We take care of your<br>garden & tree</h1>
        <p>
            GrowEarth telah berkembang menjadi organisasi yang berkomitmen pada reboisasi melalui solusi inovatif untuk pelestarian dan pengelolaan lingkungan
        </p>
    </div>

    <div class="container-konten">
        <div class="text-body">
            <h1>Welcome To Garden Tree</h1>
            <h2> We Cultivate  More Than Just Plant</h2>
        </div>
        <div>
            <p class="text-paragraf1">GrowEarth adalah platform donasi yang menghubungkan kepedulian Anda dengan aksi nyata penanaman hutan kembali. Setiap kontribusi membantu memulihkan ekosistem, menanam harapan, dan menjaga bumi untuk generasi mendatang.</p>
            <a href="{{ route('about') }}" class="btn-about-us">About Us</a>
        </div>
        <div class="gambar-konten1">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="laravel-web-growearth">
        </div>
    </div>

    <div class="gambar-konten3">
        <img src="{{ asset('images/gambar5.jpg') }}" alt="laravel-web-growearth">
    </div>

    <section class="section-pohon">
        <div class="content-wrapper">
            <div class="ilustrasi">
                <img src="{{ asset('images/gambarHome.jpg') }}" alt="Ilustrasi Penanaman Pohon">
            </div>

            <div class="text-content">
                <div class="heading">
                    <h2>MENGAPA<br>Penanaman Pohon di<br>Indonesia Sangat Penting</h2>
                </div>

                <p class="intro-text">
                    Indonesia memiliki hutan hujan tropis yang kaya sebagai rumah 
                    bagi berbagai satwa langka, seperti harimau Sumatra dan 
                    burung cenderawasih. Namun, keberadaan hutan ini kini 
                    semakin terancam.
                </p>

                <p class="problem-text">
                    Dalam beberapa dekade terakhir, kerusakan hutan meningkat, 
                    menyebabkan hilangnya habitat satwa dan pelepasan karbon 
                    yang memperparah krisis iklim.
                </p>

                <p class="program-title">
                    Melalui program GrowEarth WWF-Indonesia, partisipasimu dapat:
                </p>

                <ul class="benefits-list">
                    <li>Menghadirkan pohon-pohon baru yang berperan sebagai penyangga kehidupan Bumi.</li>
                    <li>Menyediakan habitat bagi satwa liar serta menjaga keberagaman hayati.</li>
                    <li>Mengikat karbon dan membantu menstabilkan iklim.</li>
                </ul>

                <p class="closing-text">
                    Setiap pohon yang kamu tanam merupakan wujud aksi nyata 
                    untuk menciptakan masa depan yang lebih hijau, seimbang, 
                    dan berkelanjutan.
                </p>
            </div>
        </div>
    </section>

    <section class="section-program">
        <div class="gambar-konten2">
            <img src="{{ asset('images/gambar2.png') }}" alt="laravel-web-growearth">
        </div>
        <div class="container">
            <div class="header-text">
                <h2>Kami Hadir</h2>
                <p>
                    Mengajak kita kembali mendekat dengan alam melalui aksi 
                    sederhana yang berdampak besar, yaitu menanam pohon 
                    untuk menjaga keberlanjutan kehidupan.
                </p>
                <p>
                    Mari ambil bagian dalam perubahan positif melalui program-program 
                    yang kami hadirkan berikut ini.
                </p>
            </div>

            <div class="cards-wrapper">
                
                <a href="{{ route('donasi') }}" class="card-link">
                    <div class="program-card">
                        <div class="card-image">
                            <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=800" alt="Donasi Pohon">
                        </div>
                        <div class="card-content">
                            <h3>Donasi pohon</h3>
                        </div>
                    </div>
                </a>

                <a href="{{ route('monitoring') }}" class="card-link">
                    <div class="program-card">
                        <div class="card-image">
                            <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800" alt="Monitoring Pohon">
                        </div>
                        <div class="card-content">
                            <h3>Monitoring Pohon</h3>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <section class="section-benefit">
        <div class="container-benefit">
            <div class="intro-section">
                <p>
                    Bersama GrowEarth, kamu bisa menjadi bagian dari perubahan nyata untuk 
                    Bumi. Tanam pohon sekarang dan lihat kebaikanmu tumbuh dan memberi kehidupan.
                </p>
                <h3>Apa yang Akan Anda Dapatkan:</h3>
            </div>

            <div class="benefit-cards">
                <div class="benefit-card">
                    <div class="benefit-image">
                        <img src="{{ asset('images/gambar3.jpg') }}" alt="Kode Pohon Unik">
                    </div>
                    <h4>Kode Pohon Unik:</h4>
                    <p>
                        Untuk memantau lokasi pohonmu dan kondisi tanaman secara berkala.
                    </p>
                </div>

                <div class="benefit-card">
                    <div class="benefit-image">
                        <img src="{{ asset('images/gambar4.jpg') }}" alt="Laporan Berkala">
                    </div>
                    <h4>Laporan Berkala:</h4>
                    <p>
                        Ikuti perkembangan pohon pasca-penanaman, dan rasakan kebanggaan melihat dampak 
                        positif yang kamu ciptakan.
                    </p>
                </div>
            </div>

            <div class="green-line"></div>
        </div>
    </section>

    @include('partials.footer')

</body>
</html>