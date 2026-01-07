<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Berhasil - GrowEarth</title>
    <link rel="stylesheet" href="{{ asset('styledonasi.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #8097ffff 0%, #82edf0ff 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .success-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 40px;
            text-align: center;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideUp 0.6s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    
        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #27ae60, #229954);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 50px;
            color: white;
            animation: scaleIn 0.5s ease 0.2s both;
        }
        
        @keyframes scaleIn {
            from { transform: scale(0); }
            to { transform: scale(1); }
        }
        
        .success-container h1 {
            color: #2d3436;
            margin-bottom: 10px;
            font-size: 32px;
            font-weight: 700;
        }
        
        .success-container > p {
            color: #636e72;
            margin-bottom: 40px;
            font-size: 18px;
        }
        
        .donation-summary {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin: 30px 0;
            text-align: left;
        }
        
        .donation-summary h4 {
            color: #2d3436;
            margin-bottom: 15px;
            padding-bottom: 10px;
            gap: 10px;
            border-bottom: 2px solid #ecf0f1;
            display: flex;
            align-items: center;
        }
        
        .donation-summary ul {
            list-style: none;
            padding: 0;
        }
        
        .donation-summary li {
            padding: 10px 0;
            color: #636e72;
            display: flex;
            justify-content: space-between;
        }
        
        .donation-summary strong {
            color: #2d3436;
        }
        
        .tracking-codes {
            background: linear-gradient(135deg, #8097ffff 70%, #764ba2 100%);
            padding: 30px;
            border-radius: 15px;
            margin: 30px 0;
            color: white;
        }
        
        .tracking-codes h3 {
            color: white;
            margin-bottom: 10px;
            font-size: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .tracking-codes > p {
            color: rgba(255,255,255,0.9);
            font-size: 14px;
            margin-bottom: 20px;
        }
        
        .code-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .code-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        
        .code {
            font-size: 28px;
            font-weight: 700;
            color: #8097ffff;
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
        }
        
        .code-card button {
            background: linear-gradient(135deg, #8097ffff, #764ba2);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .code-card button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(158, 175, 255, 0.8);
        }
        
        .info-text {
            color: #856404;
            font-size: 14px;
            margin: 20px 0;
            padding: 15px;
            background: #fff3cd;
            border-radius: 10px;
            border-left: 4px solid #ffc107;
            text-align: left;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 15px 40px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            border: none;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #27ae60, #229954);
            color: white;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }
        
        .btn-secondary {
            background: white;
            color: #8097ffff;
            border: 2px solid #8097ffff;
        }
        
        .btn-secondary:hover {
            background: #8097ffff;
            color: white;
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .success-container {
                padding: 30px 20px;
            }
            
            .code {
                font-size: 20px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h1> Terima Kasih atas Donasi Anda!</h1>
        <p>Pohon Anda berhasil ditanam dan akan segera tumbuh</p>
        
        @if($donations->isNotEmpty())
            <div class="donation-summary">
                <h4>
                    <i class="fas fa-info-circle"></i>
                    Ringkasan Donasi
                </h4>
                <ul>
                    <li>
                        <strong>Jumlah Pohon:</strong>
                        <span>{{ $donations->count() }} pohon</span>
                    </li>
                    <li>
                        <strong>Jenis Pohon:</strong>
                        <span>{{ $donations->first()->treeType->nama_pohon }}</span>
                    </li>
                    <li>
                        <strong>Lokasi:</strong>
                        <span>{{ $donations->first()->location }}</span>
                    </li>
                    <li>
                        <strong>Program:</strong>
                        <span>{{ $donations->first()->program }}</span>
                    </li>
                    <li>
                        <strong>Total Donasi:</strong>
                        <span>Rp {{ number_format($donations->sum('amount'), 0, ',', '.') }}</span>
                    </li>
                </ul>
            </div>
        @endif
        
        <div class="tracking-codes">
            <h3>
                <i class="fas fa-barcode"></i>
                Kode Tracking Pohon Anda
            </h3>
            <p>Simpan kode ini untuk memantau pertumbuhan pohon Anda</p>
            
            @foreach($codes as $code)
                <div class="code-card">
                    <span class="code">{{ $code }}</span>
                    <button onclick="copyCode('{{ $code }}')">
                        <i class="fas fa-copy"></i>
                        Salin
                    </button>
                </div>
            @endforeach
        </div>
        
        <p class="info-text">
            <i class="fas fa-envelope"></i>
            Kode tracking telah dikirim ke email Anda: 
            <strong>{{ $donations->first()->donor_email ?? '' }}</strong>
        </p>
        
        <div class="action-buttons">
            <a href="{{ route('monitoring') }}" class="btn btn-primary">
                <i class="fas fa-search-location"></i>
                Pantau Pohon Sekarang
            </a>
            <a href="{{ route('donasi') }}" class="btn btn-secondary">
                <i class="fas fa-plus-circle"></i>
                Tanam Pohon Lagi
            </a>
        </div>
    </div>
    
    @include('partials.footer')
    
    <script>
        function copyCode(code) {
            navigator.clipboard.writeText(code).then(function() {
                alert(' Kode berhasil disalin: ' + code);
            }).catch(function(err) {
                console.error('Gagal menyalin:', err);
                alert(' Gagal menyalin kode');
            });
        }
    </script>
</body>
</html>