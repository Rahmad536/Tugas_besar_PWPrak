<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Monitoring Pohon - GrowEarth</title>
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('stylemonitoring.css') }}">
</head>
<body>
    @include('partials.navbar')
    
    <div class="Gambar-home">
        <img src="{{ asset('images/gambarHome.jpg') }}" alt="laravel-web-growearth">
    </div>
    
    <div class="hero-text">
        <h1>Monitoring Pohon<br>Your Trees</h1>
        <p>
            Pantau perkembangan pohon yang telah Anda tanam. Setiap pohon memiliki kode unik untuk melacak pertumbuhan dan kondisi kesehatan pohon Anda secara real-time.
        </p>
    </div>
    
    <main class="main-content">
        <h1 class="page-title">Monitoring Pohon</h1>
        
        <div class="content-grid">
            <!-- Map Section -->
            <div class="card">
                <div class="search-box">
                    <input type="text" id="treeIdInput" placeholder="Masukkan ID Pohon (Contoh: TR-001)">
                    <button onclick="searchTree()">
                        <i class="fas fa-search"></i> Cari Pohon
                    </button>
                </div>
                
                <div id="map"></div>
                <p class="map-label">
                    <i class="fas fa-map-marker-alt" style="color: #d63031;"></i>
                    Lokasi pohon akan ditandai dengan pin merah
                </p>
            </div>
            
            <!-- Details Section -->
            <div class="card details-card" id="treeDetails">
                <h3><i class="fas fa-tree"></i> Detail Pohon</h3>
                
                <ul class="info-list">
                    <li><b>ID Pohon:</b> <span id="detailId">-</span></li>
                    <li><b>Jenis:</b> <span id="detailType">-</span></li>
                    <li><b>Tanggal Tanam:</b> <span id="detailDate">-</span></li>
                    <li><b>Usia:</b> <span id="detailAge">-</span></li>
                    <li><b>Lokasi:</b> <span id="detailLoc">-</span></li>
                    <li><b>Kesehatan:</b> <span id="detailHealth">-</span></li>
                </ul>
                
                <div class="progress-section">
                    <p><b>Fase Pertumbuhan</b></p>
                    <div class="progress-bar">
                        <div class="progress" id="detailProgress"></div>
                    </div>
                </div>
                
                <div class="gallery">
                    <h4>Galeri Foto</h4>
                    <div class="gallery-grid">
                        <div>
                            <img src="{{ asset('images/galeri-foto1.png') }}" alt="Bulan 1">
                            <p>Bulan 1</p>
                        </div>
                        <div>
                            <img src="{{ asset('images/galeri-foto2.jpeg') }}" alt="Bulan 6">
                            <p>Bulan 6</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    @include('partials.footer')
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        // Initialize map centered on Indonesia
        const map = L.map('map', {
            center: [-2.5, 118],
            zoom: 5,
            minZoom: 4,
            maxZoom: 18,
            maxBounds: [[6, 95], [-11, 141]],
            maxBoundsViscosity: 1.0
        });
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        
        let marker;
        
        // FUNGSI SEARCH TREE (SUDAH DIPERBAIKI)
        async function searchTree() {
            const id = document.getElementById('treeIdInput').value.trim().toUpperCase();
            
            if (!id) {
                alert('Silakan masukkan kode tracking pohon');
                return;
            }
            
            try {
                console.log('🔍 Searching for tree:', id);
                
                // Fetch data from WEB route (BUKAN /api/tree)
                const response = await fetch(`/tree/${id}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    credentials: 'same-origin'
                });
                
                console.log('📡 Response status:', response.status);
                
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('❌ Error response:', errorText);
                    throw new Error('Pohon tidak ditemukan');
                }
                
                const tree = await response.json();
                console.log('✅ Tree data:', tree);
                
                // Fly to location
                map.flyTo([tree.lat, tree.lng], 13, {
                    duration: 1.5
                });
                
                // Update marker
                if (marker) map.removeLayer(marker);
                marker = L.marker([tree.lat, tree.lng])
                    .addTo(map)
                    .bindPopup(`<b>${tree.type}</b><br>${tree.location}`)
                    .openPopup();
                
                // Show and update details
                setTimeout(() => {
                    const details = document.getElementById('treeDetails');
                    details.classList.add('show');
                    
                    document.getElementById('detailId').textContent = id;
                    document.getElementById('detailType').textContent = tree.type;
                    document.getElementById('detailDate').textContent = tree.date;
                    
                    // Display age
                    if (tree.age_years > 0) {
                        document.getElementById('detailAge').textContent = `${tree.age_years} Tahun ${tree.age_months} Bulan`;
                    } else {
                        document.getElementById('detailAge').textContent = `${tree.age_months} Bulan`;
                    }
                    
                    document.getElementById('detailLoc').textContent = tree.location;
                    document.getElementById('detailHealth').textContent = tree.health;
                    document.getElementById('detailProgress').style.width = tree.progress;
                }, 500);
                
            } catch (error) {
                console.error('💥 Error:', error);
                alert('Pohon tidak ditemukan! Pastikan kode tracking benar.');
            }
        }
        
        // Enter key support
        document.getElementById('treeIdInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchTree();
            }
        });
    </script>
</body>
</html>