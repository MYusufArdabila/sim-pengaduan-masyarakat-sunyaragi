<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIM Pengaduan Kelurahan Sunyaragi</title>
    <meta name="description" content="Masuk ke Sistem Informasi Pengaduan Masyarakat Kelurahan Sunyaragi, Kota Cirebon.">
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

        .logo-shield .logo-icon {
            font-size: 1.8rem;
            color: #fff;
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
        }

        /* ── Form labels ── */
        .f-label {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: .45rem;
        }

        /* ── Input wrapper ── */
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
            padding: .7rem 2.6rem .7rem 2.6rem;
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

        /* eye toggle */
        .toggle-eye {
            position: absolute;
            right: .95rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            font-size: 1.05rem;
            cursor: pointer;
            padding: 0;
            z-index: 2;
            line-height: 1;
        }
        .toggle-eye:hover { color: #1a5fcb; }

        /* ── Remember / forgot row ── */
        .extras-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.4rem;
        }

        .check-wrap {
            display: flex;
            align-items: center;
            gap: .45rem;
        }

        .check-wrap input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #1a5fcb;
            cursor: pointer;
        }

        .check-wrap label {
            font-size: .83rem;
            color: #4b5563;
            cursor: pointer;
        }

        .link-forgot {
            font-size: .83rem;
            color: #1a5fcb;
            font-weight: 500;
            text-decoration: none;
        }
        .link-forgot:hover { text-decoration: underline; }

        /* ── Buttons ── */
        .btn-login {
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
        }
        .btn-login:hover {
            background: #1044a8;
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(26,95,203,0.38);
        }
        .btn-login:active { transform: translateY(0); }

        /* ── OR divider ── */
        .or-row {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin: 1.3rem 0;
        }
        .or-row::before,
        .or-row::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }
        .or-row span {
            font-size: .82rem;
            color: #9ca3af;
        }

        /* ── Register button ── */
        .btn-register {
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
        .btn-register:hover {
            background: #ebf2ff;
            color: #1044a8;
            transform: translateY(-1px);
        }

        /* ── Footer note ── */
        .footer-note {
            text-align: center;
            font-size: .84rem;
            color: #8898aa;
            margin-top: .9rem;
        }
        .footer-note a {
            color: #1a5fcb;
            font-weight: 600;
            text-decoration: none;
        }
        .footer-note a:hover { text-decoration: underline; }

        /* ── Error alert ── */
        .err-box {
            display: flex;
            align-items: center;
            gap: .5rem;
            background: #fff5f5;
            border: 1px solid #fecaca;
            border-radius: 10px;
            color: #b91c1c;
            font-size: .84rem;
            padding: .65rem .9rem;
            margin-bottom: 1.1rem;
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
            @php $logoPath = \App\Models\Setting::get('logo_path'); @endphp
            <div class="logo-shield">
                @if($logoPath)
                    <img src="{{ Storage::url($logoPath) }}" alt="Logo Kelurahan">
                @else
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 3L5 8v10c0 8.284 5.582 16.029 13 18 7.418-1.971 13-9.716 13-18V8L18 3z" fill="#FFD600" stroke="rgba(255,255,255,0.4)" stroke-width="1"/>
                        <text x="18" y="23" text-anchor="middle" font-size="13" font-weight="700" fill="#1044a8" font-family="Inter,sans-serif">KS</text>
                    </svg>
                @endif
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
            @php
                // Works for both: php artisan serve (127.0.0.1:8000) and XAMPP (localhost/...)
                $base = rtrim(request()->getSchemeAndHttpHost() . request()->getBasePath(), '/');
                $photoUrl = $base . '/images/gua_sunyaragi.jpg';
            @endphp
            <img
                src="{{ $photoUrl }}"
                alt="Gua Sunyaragi, Cirebon"
                style="width:100%;height:100%;object-fit:cover;object-position:center top;">
        </div>
    </div>

    {{-- ═══════════════ RIGHT PANEL ═══════════════ --}}
    <div class="panel-right">
        <h2 class="welcome-title">Selamat Datang Kembali! </h2>
        <p class="welcome-sub">Silakan masuk untuk melanjutkan</p>

        {{-- Error message --}}
        @if($errors->any())
            <div class="err-box">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" novalidate>
            @csrf

            {{-- Email --}}
            <label for="login_email" class="f-label">Email atau Username</label>
            <div class="field-wrap">
                <i class="bi bi-person f-icon"></i>
                <input
                    type="email"
                    class="f-input @error('email') is-invalid @enderror"
                    id="login_email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="contoh@email.com">
            </div>

            {{-- Password --}}
            <label for="login_password" class="f-label">Password</label>
            <div class="field-wrap">
                <i class="bi bi-lock f-icon"></i>
                <input
                    type="password"
                    class="f-input"
                    id="login_password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Masukkan password">
                <button type="button" class="toggle-eye" id="toggleEye" aria-label="Tampilkan password">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </button>
            </div>

            {{-- Remember + Forgot --}}
            <div class="extras-row">
                <div class="check-wrap">
                    <input type="checkbox" name="remember" id="remember_me">
                    <label for="remember_me">Ingat saya</label>
                </div>
                <a href="#" class="link-forgot">Lupa password?</a>
            </div>

            {{-- Masuk button --}}
            <button type="submit" class="btn-login" id="btnMasuk">
                Masuk
            </button>
        </form>

        {{-- Divider --}}
        <div class="or-row"><span>atau</span></div>

        {{-- Register button --}}
        <a href="{{ route('register') }}" class="btn-register" id="btnDaftar">
            <i class="bi bi-person-plus"></i>
            Daftar Akun Baru
        </a>

        {{-- Footer --}}
        <p class="footer-note">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </p>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Password toggle
    document.getElementById('toggleEye').addEventListener('click', function () {
        var inp  = document.getElementById('login_password');
        var icon = document.getElementById('eyeIcon');
        if (inp.type === 'password') {
            inp.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            inp.type = 'password';
            icon.className = 'bi bi-eye';
        }
    });
</script>
</body>
</html>
