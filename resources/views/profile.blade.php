<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('styleprofile.css') }}">
    <title>Profil Kontribusi Penanaman Pohon</title>
</head>
<body>
    @include('partials.navbar')

<div class="hero" id="hero-section"
    @if($user->background_image_url)
        style="background-image: url('{{ $user->background_image_url }}')"
    @endif>
</div>

    <!-- Profile Section -->
    <div class="profile-container">
        <!-- Profile Card -->
        <div class="profile-card">
            <div class="profile-image-wrapper">
                <div class="profile-image" id="profile-image" 
                     @if($user->profile_image_url)
                     style="background-image: url('{{ $user->profile_image_url }}'); background-size: cover;"
                     @endif>
                    @if(!$user->profile_image_url)
                    <span id="profile-emoji">👤</span>
                    @endif
                </div>
            </div>
            <div class="settings-icon" onclick="openSettingsModal()">⚙️</div>
            <h1 class="profile-name" id="profile-name">{{ $user->name ?? $user->username }}</h1>
            <p class="profile-motto" id="profile-motto">{{ $user->bio ?? 'Menanam Hari Ini, Menghijaukan Masa Depan' }}</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🌲</div>
                <div class="stat-number">{{ $totalTrees }}</div>
                <div class="stat-label">Total Pohon Ditanam</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💚</div>
                <div class="stat-number">{{ $co2Absorbed }}kg</div>
                <div class="stat-label">CO₂ Diserap/Tahun</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏆</div>
                <div class="stat-number">{{ $contributionMonths }}</div>
                <div class="stat-label">Bulan Berkontribusi</div>
            </div>
        </div>

        <!-- History Section -->
        <div class="history-section">
            <div class="section-header">
                <h2 class="section-title">Riwayat Penanaman</h2>
            </div>
            <div class="table-responsive">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pohon</th>
                            <th>Tanggal Tanam</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $index => $donation)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $donation->treeType->nama_pohon ?? 'Pohon' }}</td>
                            <td>{{ $donation->created_at->format('d M Y') }}</td>
                            <td>{{ $donation->location }}</td>
                            <td>
                                <span class="status-badge status-tumbuh">Tumbuh Subur</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px;">
                                Belum ada riwayat penanaman. <br>
                                <a href="{{ route('donasi') }}" class="btn-tanam" style="margin-top: 10px;">Mulai Menanam</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Settings -->
    <div id="settingsModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeSettingsModal()">&times;</span>
            <h2 class="modal-title">Pengaturan Profil</h2>
            
            <form id="profileForm" enctype="multipart/form-data">
                @csrf
                
                <!-- Section: Foto Profil -->
                <div class="settings-section">
                    <div class="section-label">Foto Profil</div>
                    <div class="form-group">
                        <div class="file-input-wrapper">
                            <input type="file" id="profile-image-input" name="profile_image" accept="image/*" onchange="previewProfileImage(event)">
                            <label for="profile-image-input" class="file-input-label">
                                Pilih Foto Profil
                            </label>
                        </div>
                        <div class="file-name" id="profile-image-name"></div>
                        <img id="profile-image-preview" class="preview-image">
                    </div>
                </div>

                <!-- Section: Background Hero -->
                <div class="settings-section">
                    <div class="section-label">Background Profile</div>
                    <div class="form-group">
                        <div class="file-input-wrapper">
                            <input type="file" id="background-input" name="background_image" accept="image/*" onchange="previewBackground(event)">
                            <label for="background-input" class="file-input-label">
                                Pilih Background
                            </label>
                        </div>
                        <div class="file-name" id="background-name"></div>
                        <img id="background-preview" class="preview-image">
                    </div>
                </div>

                <!-- Section: Informasi Profil -->
                <div class="settings-section">
                    <div class="section-label">Informasi Profil</div>
                    <div class="form-group">
                        <label for="edit-name">Nama</label>
                        <input type="text" id="edit-name" name="name" placeholder="Masukkan nama Anda" value="{{ $user->name ?? $user->username }}">
                    </div>

                    <div class="form-group">
                        <label for="edit-bio">Bio / Motto</label>
                        <textarea id="edit-bio" name="bio" placeholder="Masukkan bio atau motto Anda">{{ $user->bio }}</textarea>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-secondary" onclick="closeSettingsModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span id="save-text">Simpan</span>
                        <span id="loading-text" style="display: none;">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Setup CSRF token untuk semua AJAX request
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Fungsi untuk membuka/menutup modal settings
        function openSettingsModal() {
            document.getElementById('settingsModal').style.display = 'block';
        }

        function closeSettingsModal() {
            document.getElementById('settingsModal').style.display = 'none';
            document.getElementById('profileForm').reset();
            document.getElementById('profile-image-preview').style.display = 'none';
            document.getElementById('background-preview').style.display = 'none';
            document.getElementById('profile-image-name').textContent = '';
            document.getElementById('background-name').textContent = '';
        }

        // Tutup modal saat klik di luar
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                closeSettingsModal();
            }
        }

        // Fungsi preview gambar profil
        function previewProfileImage(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('❌ Ukuran file terlalu besar! Maksimal 5MB');
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-image-preview').src = e.target.result;
                    document.getElementById('profile-image-preview').style.display = 'block';
                    document.getElementById('profile-image-name').textContent = '✅ ' + file.name;
                }
                reader.readAsDataURL(file);
            }
        }

        // Fungsi preview background
        function previewBackground(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('❌ Ukuran file terlalu besar! Maksimal 5MB');
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('background-preview').src = e.target.result;
                    document.getElementById('background-preview').style.display = 'block';
                    document.getElementById('background-name').textContent = '✅ ' + file.name;
                }
                reader.readAsDataURL(file);
            }
        }

        // Handle form submit dengan AJAX
        document.getElementById('profileForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const saveText = document.getElementById('save-text');
            const loadingText = document.getElementById('loading-text');
            const submitBtn = e.target.querySelector('button[type="submit"]');

            // Show loading state
            saveText.style.display = 'none';
            loadingText.style.display = 'inline';
            submitBtn.disabled = true;

            // Buat FormData object
            const formData = new FormData(this);

            try {
                const response = await fetch('{{ route("profile.update") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Update tampilan dengan data baru
                    document.getElementById('profile-name').textContent = result.data.name;
                    document.getElementById('profile-motto').textContent = result.data.bio || 'Menanam Hari Ini, Menghijaukan Masa Depan';

                    // Update foto profil jika ada
                    if (result.data.profile_image_url) {
                        const profileImage = document.getElementById('profile-image');
                        profileImage.style.backgroundImage = `url('${result.data.profile_image_url}')`;
                        profileImage.style.backgroundSize = 'cover';
                        profileImage.innerHTML = ''; // Hapus emoji
                    }

                    // Update background jika ada
                    if (result.data.background_image_url) {
                        const heroSection = document.getElementById('hero-section');
                        heroSection.style.backgroundImage = `url('${result.data.background_image_url}')`;
                        heroSection.style.backgroundSize = 'cover';
                        heroSection.style.backgroundPosition = 'center';
                    }

                    // Animasi sukses
                    const profileCard = document.querySelector('.profile-card');
                    profileCard.style.transform = 'scale(1.05)';
                    setTimeout(() => {
                        profileCard.style.transform = 'scale(1)';
                    }, 300);

                    alert('✅ ' + result.message);
                    closeSettingsModal();
                } else {
                    // Handle validation errors (422) or other errors
                    let errorMessage = result.message || 'Terjadi kesalahan saat menyimpan';
                    if (result.errors) {
                        errorMessage += '\n' + Object.values(result.errors).flat().join('\n');
                    }
                    alert('❌ ' + errorMessage);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan saat menghubungi server.');
            } finally {
                // Reset loading state
                saveText.style.display = 'inline';
                loadingText.style.display = 'none';
                submitBtn.disabled = false;
            }
        });

        // Animasi counter (tetap sama)
        function animateCounter(element, target, suffix = '') {
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target + suffix;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current) + suffix;
                }
            }, 30);
        }

        window.addEventListener('load', () => {
            const counters = document.querySelectorAll('.stat-number');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const text = entry.target.textContent;
                        const number = parseInt(text.replace(/\D/g, ''));
                        const suffix = text.replace(/[0-9]/g, '');
                        animateCounter(entry.target, number, suffix);
                        observer.unobserve(entry.target);
                    }
                });
            });

            counters.forEach(counter => observer.observe(counter));
        });
    </script>
</body>
</html>