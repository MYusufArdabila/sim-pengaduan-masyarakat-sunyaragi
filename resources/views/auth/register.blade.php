<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | SIM Pengaduan Kelurahan Sunyaragi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a237e 0%, #283593 50%, #1565c0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .register-wrapper { width: 100%; max-width: 460px; }
        .register-header { text-align: center; margin-bottom: 1.5rem; }
        .logo-placeholder {
            width: 60px; height: 60px;
            border-radius: 14px;
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.3);
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 1.6rem; color: white; margin-bottom: .75rem;
        }
        .register-title { font-size: .95rem; font-weight: 700; color: white; margin-bottom: .2rem; }
        .register-subtitle { font-size: .8rem; color: rgba(255,255,255,0.7); }
        .register-card {
            background: white; border-radius: 20px;
            padding: 2rem; box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        }
        .form-label { font-size: .83rem; font-weight: 600; color: #37474f; }
        .form-control {
            border-radius: 10px; border: 1.5px solid #e0e3ea;
            padding: .65rem 1rem; font-size: .9rem;
        }
        .form-control:focus { border-color: #3949ab; box-shadow: 0 0 0 3px rgba(57,73,171,0.12); }
        .btn-register {
            background: linear-gradient(135deg, #1a237e, #3949ab);
            color: white; border: none; border-radius: 10px;
            padding: .75rem; font-weight: 600; width: 100%;
            transition: transform .2s, box-shadow .2s;
        }
        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(26,35,126,0.35);
            color: white;
        }
        .anon-info {
            background: #e8eaf6; border-radius: 10px;
            padding: .75rem 1rem; font-size: .8rem; color: #3949ab;
            margin-bottom: 1.25rem;
        }
        .login-link { text-align: center; font-size: .85rem; color: #607d8b; margin-top: 1.25rem; }
        .login-link a { color: #3949ab; font-weight: 600; text-decoration: none; }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <div class="register-header">
            <img src="{{ asset('images/logo_sunyaragi.jpeg') }}" style="width:60px;height:60px;border-radius:14px;object-fit:cover;margin-bottom:.75rem;" alt="Logo">
            <div class="register-title">Daftar Akun Warga</div>
            <div class="register-subtitle">{{ \App\Models\Setting::get('nama_kelurahan', 'Kelurahan Sunyaragi') }}</div>
        </div>

        <div class="register-card">
            <div class="anon-info">
                <i class="bi bi-shield-check me-2"></i>
                <strong>Akun Anonim:</strong> Identitas Anda dilindungi. Nama Anda tidak akan ditampilkan secara publik.
            </div>

            @if($errors->any())
                <div class="alert alert-danger border-0 rounded-3 py-2 mb-3" style="font-size:.85rem; background:#fff5f5;">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" name="email" value="{{ old('email') }}"
                        required placeholder="nama@gmail.com">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-muted">Email digunakan untuk login, tidak ditampilkan ke umum.</small>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" name="password"
                        required minlength="6" placeholder="Minimal 6 karakter">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                    <input type="password" class="form-control"
                        id="password_confirmation" name="password_confirmation"
                        required placeholder="Ulangi kata sandi">
                </div>
                <button type="submit" class="btn btn-register">
                    <i class="bi bi-person-plus me-2"></i>Buat Akun Warga
                </button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk sekarang</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
