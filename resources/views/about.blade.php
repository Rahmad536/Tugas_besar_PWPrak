<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami-GrowEarth</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('styleabout.css') }}">
</head>

<body>
    
    @include('partials.navbar')

    <svg viewBox="0 0 560 440">
        <defs>
            <mask id="capsuleMask">
                <rect width="100%" height="100%" fill="black"/>

                <g transform="translate(50 0) rotate(-35.95 180 220)">
                    
                    <g transform="translate(40 50)">
                        <rect width="270" height="60" rx="30" fill="white"/>
                    </g>

                    <g transform="translate(0 115)">
                        <rect width="350" height="60" rx="30" fill="white"/>
                    </g>

                    <g transform="translate(38 180)">
                        <rect width="300" height="60" rx="30" fill="white"/>
                    </g>

                    <g transform="translate(4 245)">
                        <rect width="290" height="60" rx="30" fill="white"/>
                    </g>

                </g>
            </mask>
        </defs>

        <image
            href="{{ asset('images/gambar10.jpg') }}"
            width="360"
            height="440"
            preserveAspectRatio="xMidYMid slice"
            mask="url(#capsuleMask)"
        />
    </svg>

    <section>
        <div class="mapIndo">
            <img src="{{ asset('images/mapIndonesia.png') }}" alt="">
        </div>
        <div class="konten-sebelah-kiri">
            <div class="judul1">
                <span class="kata1">Grow</span><span class="kata2">Earth</span>
            </div>
            <p class="text">"Platform digital menghubungkan masyarakat 
                dengan aksi nyata iklim 
                satu pohon demi satu perubahan"</p>
        </div>
    </section>

    <section>
        <div class="mapIndo2">
            <img src="{{ asset('images/mapIndonesia.png') }}" alt="">
        </div>

        <div class="tentang-kami">
            <h1 class="judul2">Tentang Kami</h1>
            <p class="paragraf1">Kami adalah platform digital yang berfokus pada aksi nyata pelestarian lingkungan melalui program donasi penanaman pohon. Platform ini dikembangkan sebagai respon terhadap meningkatnya risiko banjir dan dampak perubahan iklim di Indonesia, yang salah satunya disebabkan oleh berkurangnya tutupan lahan hijau.</p>
        </div>
        <div class="foto-bundar1">
            <img src="{{ asset('images/gambar11.jpeg') }}" alt="">
        </div>
    </section>

    <section>
        <div class="bagaimana-kami-memulai">
            <h1 class="judul3">Bagaimana Kami Memulai</h1>
            <p class="paragraf2">Berangkat dari permasalahan tersebut, kami menghadirkan sistem donasi digital dengan fitur pelacakan dan pemantauan pertumbuhan pohon secara berkala guna meningkatkan transparansi serta partisipasi masyarakat dalam mitigasi perubahan iklim.</p>
        </div>
    </section>

    <section>
        <div class="visiDanmisi">
            <h1 class="judul4">Nilai-Nilai Kami <br> & <br> Visi Misi</h1>
        </div>
        <div class="container1">
            <div class="content">
                <div class="item">
                    <div class="icon">
                         <span class="material-symbols-outlined">eco</span>
                    </div>
                    <h3>Keberlanjutan<br>Lingkungan</h3>
                </div>

                <div class="item">
                    <div class="icon">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <h3>Kepercayaan &<br>Transparansi</h3>
                </div>

                <div class="item">
                    <div class="icon">
                        <span class="material-symbols-outlined">Forest</span>
                    </div>
                    <h3>Aksi Nyata &<br>Pertumbuhan</h3>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="visiMisi">
            <div class="visi-content">
                <h1 class="judul5">VISI</h1>
                <p class="paragraf3">Mewujudkan lingkungan yang lebih hijau dan berkelanjutan melalui platform digital penanaman pohon yang transparan dan berdampak nyata.</p>
            </div>
            <div class="misi-content">
                <h1 class="judul6">MISI</h1>
                <p class="paragraf4">Menghubungkan masyarakat dengan aksi nyata pelestarian lingkungan melalui donasi, pelacakan, dan pemantauan pertumbuhan pohon secara berkelanjutan.</p>
            </div>
        </div>
    </section>

@include('partials.footer')

</body>
</html>