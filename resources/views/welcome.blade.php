<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Premium Music Store</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-card: #1e293b;
            --accent-gold: #fbbf24;
            --text-muted: #cbd5e1; 
        }

        body { 
            background-color: var(--bg-dark);
            color: #f8fafc;
            font-family: 'Instrument Sans', sans-serif;
            min-height: 100vh;
            padding-top: 80px;
        }

        .navbar { 
            background: rgba(15, 23, 42, 0.9) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 4px 30px rgba(0,0,0,0.3);
        }

        .hero-section { 
            background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.75)), 
                        url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            border-radius: 30px; 
            border: 1px solid rgba(255,255,255,0.1);
            margin-top: 20px;
        }

        .hero-section p.lead {
            color: #ffffff !important;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.8); 
            font-weight: 500;
        }

        .feature-box { 
            background: var(--bg-card);
            border-radius: 20px; 
            border: 1px solid rgba(255,255,255,0.05);
            transition: all 0.3s ease; 
        }

        .feature-box p.text-muted {
            color: #e2e8f0 !important;
        }

        .feature-box:hover { 
            transform: translateY(-10px); 
            border-color: var(--accent-gold);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .card-section { 
            background: #111827;
            border-radius: 25px; 
            border: 1px solid rgba(255,255,255,0.05);
        }

        .btn-custom { 
            background: var(--accent-gold);
            color: #0f172a !important;
            border: none; 
            font-weight: 700; 
            border-radius: 12px;
            transition: all 0.3s ease; 
        }

        .btn-custom:hover { 
            background: #fcd34d;
            transform: scale(1.05); 
            box-shadow: 0 0 20px rgba(255, 214, 10, 0.4);
        }

        .btn-outline-custom {
            border: 2px solid var(--accent-gold);
            color: var(--accent-gold) !important;
            font-weight: 700;
            border-radius: 12px;
        }

        .section-title { 
            letter-spacing: -1px;
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .accent-text { color: var(--accent-gold); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <span class="accent-text"></span> FEROZ MUSIC
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Explore</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-outline-custom ms-2">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="btn btn-sm btn-custom ms-2 px-3" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="hero-section p-5 text-center mb-5 shadow-lg">
            <h1 class="display-3 fw-bold section-title mb-3">TOKO MUSIK <span class="accent-text">BERKELAS</span></h1>
            <p class="lead mb-4 fs-4">Temukan instrumen premium yang dikurasi khusus untuk jiwa musisi Anda.</p>
            
        </div>

        <div class="row g-4 mb-5 text-center">
            <div class="col-md-4">
                <div class="feature-box p-5 h-100">
                    <div class="display-5 mb-3"></div>
                    <h4 class="fw-bold">KUALITAS PREMIUM</h4>
                    <p class="text-muted">Setiap alat musik telah melalui seleksi khusus oleh ahli musik.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box p-5 h-100">
                    <div class="display-5 mb-3"></div>
                    <h4 class="fw-bold">KEAMANAN</h4>
                    <p class="text-muted">Produk anda dijamin aman dan ada cashback jika terjadi kerusakan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box p-5 h-100">
                    <div class="display-5 mb-3"></div>
                    <h4 class="fw-bold">EXPRESS</h4>
                    <p class="text-muted">Pengiriman aman dengan packing kayu khusus instrumen dan dapat mengirim ke berbagai daerah.</p>
                </div>
            </div>
        </div>

        <div class="card-section p-5 mb-5 shadow">
            <div class="row text-center">
                <div class="col-md-4">
                    <h3 class="display-5 fw-bold accent-text">{{ \App\Models\Product::count() }}</h3>
                    <p class="text-uppercase small tracking-widest text-white fw-bold">Koleksi Instrumen</p>
                </div>
                <div class="col-md-4">
                    <h3 class="display-5 fw-bold accent-text">{{ \App\Models\User::count() }}</h3>
                    <p class="text-uppercase small tracking-widest text-white fw-bold">Musisi Bergabung</p>
                </div>
                <div class="col-md-4">
                    <h3 class="display-5 fw-bold accent-text">4.9/5</h3>
                    <p class="text-uppercase small tracking-widest text-white fw-bold">Kepuasan Pelanggan</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-5 border-top border-secondary mt-5">
        <div class="container text-center">
            <p class="text-white opacity-75 mb-0">&copy; 2026 Create By Feroz</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>