<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi-GrowEarth</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('styledonasi.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    @include('partials.navbar')

    <section class="hero" id="home">
        <h1>Green Forest</h1>
        <h2>Growing Hope</h2>
        <p>
            Melalui penanaman pohon secara kolektif, kita memulihkan ekosistem, memperkuat komunitas, dan menjamin planet yang lebih sehat serta tangguh bagi generasi mendatang.
        </p>
    </section>

    <section class="peta-section" id="maps">
        <h2 class="section-title">Peta Lokasi</h2>

        <div class="peta-grid">
            <div class="peta-card">
                <img src="{{ asset('images/location1.jpeg') }}" class="peta-image" alt="Kalimantan">
                <div class="peta-content">
                    <span class="peta-badge">⚲ Kalimantan</span>
                    <h3 class="peta-title">Perlindungan Hutan Hujan</h3>
                    <div class="peta-footer">
                        <span class="peta-area">Reboisasi untuk hutan Gundul di Kalimantan</span>
                        <a href="#" class="peta-btn" onclick="openDonationModal(event, 'Kalimantan', 'Perlindungan Hutan Hujan', 15000000)">Tanam</a>
                    </div>
                </div>
            </div>

            <div class="peta-card">
                <img src="{{ asset('images/location2.jpg') }}" class="peta-image" alt="Sumatra">
                <div class="peta-content">
                    <span class="peta-badge">⚲ Sumatra</span>
                    <h3 class="peta-title">Reklamasi Hutan Mangrove</h3>
                    <div class="peta-footer">
                        <span class="peta-area">Reboisasi setelah kejadian banjir di daerah Sumatra</span>
                        <a href="#" class="peta-btn" onclick="openDonationModal(event, 'Sumatra', 'Reklamasi Hutan Mangrove', 9000000)">Tanam</a>
                    </div>
                </div>
            </div>

            <div class="peta-card">
                <img src="{{ asset('images/location3.jpg') }}" class="peta-image" alt="Jakarta">
                <div class="peta-content">
                    <span class="peta-badge">⚲ Jakarta</span>
                    <h3 class="peta-title">Penghijauan Perkotaan</h3>
                    <div class="peta-footer">
                        <span class="peta-area">Mengubah kota Jakarta menjadi lebih hijau</span>
                        <a href="#" class="peta-btn" onclick="openDonationModal(event, 'Jakarta', 'Penghijauan Perkotaan', 12000000)">Tanam</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pohon-section">
        <h2 class="section-title">Jenis Pohon yang akan ditanam</h2>

        <div class="pohon-slider-wrapper">
            <button class="slider-btn left" onclick="scrollPohon(-1)">❮</button>

            <div class="pohon-slider" id="pohonSlider">
                @foreach($pohons as $pohon)
                    <div class="pohon-card">
                        <img src="{{ asset('storage/' . $pohon->gambar) }}" class="pohon-image">
                        <h3 class="pohon-name">{{ $pohon->nama_pohon }}</h3>
                        <p class="pohon-desc">{{ $pohon->deskripsi }}</p>
                    </div>
                @endforeach
            </div>

            <button class="slider-btn right" onclick="scrollPohon(1)">❯</button>
        </div>
    </section>

    <section class="cta-section">
        <p class="cta-text">
            Setiap pohon yang Anda tanam hari ini adalah warisan nyata bagi generasi mendatang.
        </p>
    </section>

    <!-- Modal Donasi -->
    <div id="donationModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeDonationModal()">&times;</span>
            <h2 class="modal-title">Form Pembelian Pohon</h2>
            <p class="modal-subtitle">Pilih jumlah pohon yang ingin Anda tanam</p>
            
            <form id="donationForm">
                @csrf
                
                <div class="location-badge" id="modal-location">
                    ⚲ <span id="location-name"></span>
                </div>

                <div class="tree-info">
                    <strong>Program:</strong> <span id="program-name"></span><br>
                    <strong>Harga per pohon:</strong> Rp <span id="price-per-tree"></span>
                </div>

                <div class="form-group">
                    <label for="tree-type">Jenis Pohon</label>
                    <select id="tree-type" name="tree_type" onchange="updateHargaSelect()" required>
                        <option value="">Pilih jenis pohon</option>
                        @foreach($pohons as $pohon)
                            <option value="{{ $pohon->id }}" data-harga="{{ $pohon->harga }}">
                                {{ $pohon->nama_pohon }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Jumlah Pohon</label>
                    <div class="quantity-controls">
                        <button type="button" class="quantity-btn" onclick="decreaseQuantity()">-</button>
                        <input type="number" id="quantity" name="quantity" class="quantity-input" value="1" min="1" max="1000" required onchange="calculateTotal()">
                        <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
                    </div>
                </div>

                <div class="price-display">
                    <div class="price-label">Total Donasi</div>
                    <div class="price-amount">Rp <span id="total-price">0</span></div>
                </div>

                <div class="form-group">
                    <label for="donor-name">Nama Donatur</label>
                    <input type="text" id="donor-name" name="donor_name" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="form-group">
                    <label for="donor-email">Email</label>
                    <input type="email" id="donor-email" name="donor_email" placeholder="email@example.com" required>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-secondary" onclick="closeDonationModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span id="submit-text">Lanjutkan Pembayaran</span>
                        <span id="loading-text" style="display: none;">Memproses...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('partials.footer')

    <script>
        // Fungsi untuk selalu ambil CSRF token terbaru
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
        
        let pricePerTree = 0;

        function openDonationModal(event, location, program) {
            event.preventDefault();
            document.getElementById('location-name').textContent = location;
            document.getElementById('program-name').textContent = program;
            document.getElementById('donationModal').style.display = 'block';
            calculateTotal();
        }

        function closeDonationModal() {
            document.getElementById('donationModal').style.display = 'none';
            document.getElementById('donationForm').reset();
            document.getElementById('quantity').value = 1;
            pricePerTree = 0;
            document.getElementById('price-per-tree').innerText = '0';
            document.getElementById('total-price').innerText = '0';
        }

        function increaseQuantity() {
            const input = document.getElementById('quantity');
            input.value = parseInt(input.value) + 1;
            calculateTotal();
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value--;
                calculateTotal();
            }
        }

        function calculateTotal() {
            const qty = parseInt(document.getElementById('quantity').value) || 1;
            const total = pricePerTree * qty;
            document.getElementById('total-price').innerText = formatRupiah(total);
        }

        function formatRupiah(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }

        function pilihPohonLangsung(event, id, harga) {
            event.preventDefault();
            document.getElementById('donationModal').style.display = 'block';
            pricePerTree = harga;
            document.getElementById('price-per-tree').innerText = formatRupiah(harga);

            const select = document.getElementById('tree-type');
            for (let opt of select.options) {
                if (parseInt(opt.value) === id) {
                    opt.selected = true;
                    break;
                }
            }
            calculateTotal();
        }

        function updateHargaSelect() {
            const select = document.getElementById('tree-type');
            const opt = select.options[select.selectedIndex];
            pricePerTree = parseInt(opt.dataset.harga || 0);
            document.getElementById('price-per-tree').innerText = formatRupiah(pricePerTree);
            calculateTotal();
        }

        function scrollPohon(direction) {
            const slider = document.getElementById('pohonSlider');
            const scrollAmount = 320;
            slider.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }

        // ===== FORM SUBMIT - USER HARUS LOGIN =====
        document.getElementById('donationForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.querySelector('.btn-primary');
            submitBtn.disabled = true;
            document.getElementById('submit-text').style.display = 'none';
            document.getElementById('loading-text').style.display = 'inline';
            
            const formData = {
                tree_type_id: document.getElementById('tree-type').value,
                quantity: document.getElementById('quantity').value,
                donor_name: document.getElementById('donor-name').value,
                donor_email: document.getElementById('donor-email').value,
                location: document.getElementById('location-name').textContent,
                program: document.getElementById('program-name').textContent,
                total_amount: pricePerTree * parseInt(document.getElementById('quantity').value)
            };
            
            console.log('📝 Sending donation data:', formData);
            
            try {
                const response = await fetch('/donasi/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(formData)
                });
                
                console.log('📡 Response status:', response.status);
                
                // Check jika 401 Unauthorized atau 419 (session expired)
                if (response.status === 401 || response.status === 419) {
                    alert('Sesi Anda telah berakhir. Halaman akan di-refresh.');
                    // Refresh halaman untuk dapat CSRF token baru
                    window.location.reload();
                    return;
                }
                
                // Check content type response
                const contentType = response.headers.get('content-type');
                
                // Jika dapat HTML = redirect ke login
                if (contentType && contentType.includes('text/html')) {
                    console.warn('⚠️ User belum login - redirecting to login page');
                    alert('Anda harus login terlebih dahulu untuk melakukan donasi.');
                    window.location.href = '/login?redirect=' + encodeURIComponent(window.location.pathname);
                    return;
                }
                
                // Parse JSON response
                const result = await response.json();
                console.log('✅ Response data:', result);
                
                // Check jika ada message "Unauthenticated"
                if (result.message === 'Unauthenticated.' || result.message === 'Unauthenticated') {
                    alert('Anda harus login terlebih dahulu untuk melakukan donasi.');
                    window.location.href = '/login?redirect=' + encodeURIComponent(window.location.pathname);
                    return;
                }
                
                if (response.ok && result.success) {
                    alert('Donasi berhasil! Anda akan diarahkan ke halaman konfirmasi.');
                    window.location.href = `/donasi/success?codes=${result.tracking_codes.join(',')}`;
                } else {
                    // Handle error dari server
                    alert('Error: ' + (result.message || 'Terjadi kesalahan saat memproses donasi'));
                }
                
            } catch (error) {
                console.error('💥 Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            } finally {
                submitBtn.disabled = false;
                document.getElementById('submit-text').style.display = 'inline';
                document.getElementById('loading-text').style.display = 'none';
            }
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('donationModal');
            if (event.target === modal) {
                closeDonationModal();
            }
        }
    </script>

</body>
</html>