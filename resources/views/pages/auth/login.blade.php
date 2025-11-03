<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Informasi Kebencanaan</title>

    {{-- Font & Icon --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background: linear-gradient(135deg, #eef2ff, #f8f9ff);
        }

        /* === SPLIT CONTAINER === */
        .login-wrapper {
            display: flex;
            width: 100%;
            background: #b8e5ff;
        }

        .login-image {
            flex: 1;
            background: url("{{ asset('assets-admin/images/auth/desaaaaaa.jpg') }}") center/cover no-repeat;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2rem 2.5rem;
            color: #fff;
        }

        .login-image::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(30, 58, 138, 0.55);
            z-index: 0;
        }

        .login-image h2,
        .login-image h3 {
            position: relative;
            z-index: 1;
            margin: 0;
        }

        .login-image h2 {
            font-size: 1.8rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .login-image h3 {
            font-size: 1.1rem;
            font-weight: 400;
            opacity: 0.95;
            margin-top: 0.3rem;
        }

        .login-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .login-box {
            width: 100%;
            max-width: 380px;
            background: #ffffff;
            padding: 2rem 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.7s ease;
        }

        .login-box h3 {
            color: #1e3a8a;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            color: #1e293b;
            font-weight: 500;
            display: block;
            margin-bottom: 0.4rem;
        }

        .form-input {
            position: relative;
        }

        .form-input i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }

        .form-input input {
            width: 100%;
            padding: 0.65rem 0.9rem 0.65rem 2.2rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: 0.2s;
        }

        .form-input input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 6px rgba(59, 130, 246, 0.4);
        }

        .btn-primary {
            width: 100%;
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .btn-primary:hover {
            background: #1e40af;
        }

        .alert {
            background: #fee2e2;
            color: #b91c1c;
            border-left: 4px solid #dc2626;
            padding: 0.7rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .text-muted {
            font-size: 0.85rem;
            color: #9ca3af;
            text-align: center;
            margin-top: 1.5rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* === RESPONSIVE === */
        @media (max-width: 850px) {
            body {
                flex-direction: column;
            }

            .login-wrapper {
                flex-direction: column;
            }

            .login-image {
                height: 220px;
                flex: none;
                border-radius: 0 0 1rem 1rem;
            }

            .login-image h2 {
                font-size: 1.4rem;
                bottom: 1rem;
                left: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        {{-- LEFT SIDE --}}
        <div class="login-image">
            <h2>Sistem Informasi Bina Desa</h2>
            <h3>Kebencanaan & Tanggap Darurat</h3>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="login-container">
            <div class="login-box">
                <h3>Login Admin</h3>
                <p class="subtitle">Masuk ke Sistem Informasi Kebencanaan</p>

                {{-- Error validation --}}
                @if ($errors->any())
                    <div class="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Error login --}}
                @if (session('error'))
                    <div class="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="form-input">
                            <i class="fa-solid fa-user"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="form-input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password" name="password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">Masuk</button>
                </form>

                <p class="text-muted">&copy; {{ date('Y') }} Sistem Informasi Kebencanaan</p>
            </div>
        </div>
    </div>
</body>

</html>
