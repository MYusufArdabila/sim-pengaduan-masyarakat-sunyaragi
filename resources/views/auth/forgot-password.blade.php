<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | SIM Pengaduan Kelurahan Sunyaragi</title>
    <meta name="description" content="Halaman Lupa Password Sistem Informasi Pengaduan Masyarakat Kelurahan Sunyaragi, Kota Cirebon.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #eef2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        /* ══════════════════════════════════
           CONTAINER
        ══════════════════════════════════ */
        .login-card {
            display: flex;
            width: 100%;
            max-width: 980px;
            min-height: 600px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            background: #fff;
            animation: fadeUp .45s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ══════════════════════════════════
           LEFT PANEL
        ══════════════════════════════════ */
        .panel-left {
            flex: 0 0 42%;
            background: linear-gradient(160deg, #1e3fa0 0%, #1a5fcb 45%, #1044a8 100%);
            display: flex;
            flex-direction: column;
            padding: 2rem 2rem 0 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles */
        .deco-circle-1 {
            position: absolute;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            top: -100px;
            right: -130px;
            pointer-events: none;
        }
        .deco-circle-2 {
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: 200px;
            left: -80px;
            pointer-events: none;
        }

        /* ── Logo row ── */
        .logo-row {
            display: flex;
            align-items: center;
            gap: .8rem;
            position: relative;
            z-index: 2;
        }

        .logo-shield {
            width: 58px;
            height: 58px;
            border-radius: 12px;
            background: rgba(0,0,0,0.35);
            border: 1.5px solid rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .logo-shield img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo-info h6 {
            font-size: .9rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.25;
            margin: 0;
        }

        .logo-info small {
            font-size: .76rem;
            color: rgba(255,255,255,0.72);
        }

        /* ── Main text ── */
        .panel-body {
            margin-top: 2.2rem;
            position: relative;
            z-index: 2;
        }

        .panel-body h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.25;
            margin-bottom: .85rem;
        }

        .accent-bar {
            width: 46px;
            height: 4px;
            background: #FFD600;
            border-radius: 2px;
            margin-bottom: 1rem;
        }

        .panel-body p {
            font-size: .875rem;
            color: rgba(255,255,255,0.78);
            line-height: 1.65;
        }

        /* ── Bottom photo ── */
        .panel-photo {
            margin-top: auto;
            margin-left: -2rem;
            margin-right: -2rem;
            overflow: hidden;
            position: relative;
            z-index: 2;
            height: 270px;
            background: #0d3b8a;
            flex-shrink: 0;
        }

        .panel-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
            display: block;
        }

        /* gradient overlay on photo */
        .panel-photo::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 60px;
            background: linear-gradient(to bottom, rgba(30,63,160,0.65), transparent);
            pointer-events: none;
        }

        /* ══════════════════════════════════
           RIGHT PANEL
        ══════════════════════════════════ */
        .panel-right {
            flex: 1;
            padding: 3rem 3.25rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        .welcome-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: .3rem;
        }

        .welcome-sub {
            font-size: .875rem;
            color: #8898aa;
            margin-bottom: 1.8rem;
            line-height: 1.5;
        }

        /* ── Form elements ── */
        .f-label {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: .45rem;
        }

        .field-wrap {
            position: relative;
            margin-bottom: 1.1rem;
        }

        .field-wrap .f-icon {
            position: absolute;
            left: .95rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1rem;
            pointer-events: none;
            z-index: 2;
        }

        .field-wrap .f-input {
            width: 100%;
            padding: .7rem 2.6rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: .9rem;
            color: #1f2937;
            background: #f8fafc;
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
            font-family: inherit;
        }

        .field-wrap .f-input::placeholder { color: #b0bec5; }

        .field-wrap .f-input:focus {
            border-color: #1a5fcb;
            background: #fff;
            box-shadow: 0 0 0 3.5px rgba(26, 95, 203, 0.13);
        }

        /* ── Buttons ── */
        .btn-reset {
            width: 100%;
            padding: .8rem;
            font-size: .95rem;
            font-weight: 700;
            color: #fff;
            background: #1a5fcb;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-family: inherit;
            letter-spacing: .01em;
            transition: background .2s, transform .15s, box-shadow .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            margin-bottom: 1rem;
        }
        .btn-reset:hover {
            background: #1044a8;
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(26,95,203,0.38);
        }
        .btn-reset:active { transform: translateY(0); }

        .btn-back {
            width: 100%;
            padding: .78rem;
            font-size: .9rem;
            font-weight: 600;
            color: #1a5fcb;
            background: transparent;
            border: 1.5px solid #1a5fcb;
            border-radius: 10px;
            cursor: pointer;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            text-decoration: none;
            transition: background .2s, color .2s, transform .15s;
        }
        .btn-back:hover {
            background: #ebf2ff;
            color: #1044a8;
            transform: translateY(-1px);
        }

        /* ══════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════ */
        @media (max-width: 780px) {
            .login-card {
                flex-direction: column;
                max-width: 460px;
                min-height: unset;
            }
            .panel-left {
                flex: 0 0 auto;
                padding: 1.5rem 1.5rem 0;
            }
            .panel-photo { height: 180px; }
            .panel-body h1 { font-size: 1.4rem; }
            .panel-right { padding: 2rem 1.75rem 2.25rem; }
        }

        @media (max-width: 480px) {
            body { padding: 0; background: #fff; }
            .login-card { border-radius: 0; box-shadow: none; min-height: 100svh; }
        }
    </style>
</head>
<body>

<div class="login-card">

    {{-- ═══════════════ LEFT PANEL ═══════════════ --}}
    <div class="panel-left">
        {{-- Decorative shapes --}}
        <div class="deco-circle-1"></div>
        <div class="deco-circle-2"></div>

        {{-- Logo + Nama --}}
        <div class="logo-row">
            <div class="logo-shield">
                <img src="{{ asset('images/logo_sunyaragi.jpeg') }}" alt="Logo Kelurahan">
            </div>
            <div class="logo-info">
                <h6>{{ \App\Models\Setting::get('nama_kelurahan', 'Kelurahan Sunyaragi') }}</h6>
                <small>Kota Cirebon</small>
            </div>
        </div>

        {{-- Heading --}}
        <div class="panel-body">
            <h1>Sistem Informasi<br>Pengaduan Masyarakat</h1>
            <div class="accent-bar"></div>
            <p>Sampaikan keluhan dan aspirasi Anda<br>untuk lingkungan yang lebih baik.</p>
        </div>

        {{-- Photo Gua Sunyaragi --}}
        <div class="panel-photo">
            <img
                src="{{ asset('images/gua_sunyaragi.jpg') }}"
                alt="Gua Sunyaragi, Cirebon"
                style="width:100%;height:100%;object-fit:cover;object-position:center top;">
        </div>
    </div>

    {{-- ═══════════════ RIGHT PANEL ═══════════════ --}}
    <div class="panel-right">
        <h2 class="welcome-title">Lupa Password?</h2>
        <p class="welcome-sub">
            Masukkan alamat email Anda yang terdaftar. Kami akan mengirimkan tautan untuk mereset password Anda.
        </p>

        <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Instruksi reset password telah dikirim ke email Anda. Silakan periksa kotak masuk atau folder spam.');">
            @csrf
            
            <label for="email" class="f-label">Alamat Email</label>
            <div class="field-wrap">
                <i class="bi bi-envelope f-icon"></i>
                <input
                    type="email"
                    class="f-input"
                    id="email"
                    name="email"
                    required
                    autofocus
                    placeholder="contoh@email.com">
            </div>

            <button type="submit" class="btn-reset">
                <i class="bi bi-send"></i>
                Kirim Tautan Reset
            </button>
        </form>

        {{-- Back button --}}
        <a href="{{ route('login') }}" class="btn-back mt-3">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Login
        </a>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
