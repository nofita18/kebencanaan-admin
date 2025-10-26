<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Sistem Kebencanaan</title>
    <style>
        /* === RESET === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        /* === BACKGROUND === */
        body {
            height: 100vh;
            background: linear-gradient(135deg, #eef1ff, #f8f9ff);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* === CONTAINER === */
        .login-container {
            background: #ffffff;
            width: 380px;
            padding: 2.5rem 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            animation: fadeIn 0.7s ease;
        }

        /* === TITLE === */
        .login-container h3 {
            margin-bottom: 1rem;
            color: #1e3a8a;
            font-weight: 600;
        }

        .subtitle {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        /* === FORM === */
        .form-group {
            text-align: left;
            margin-bottom: 1rem;
        }

        .form-group label {
            font-weight: 500;
            color: #1e293b;
            display: block;
            margin-bottom: 0.4rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.65rem 0.9rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 6px rgba(59, 130, 246, 0.4);
        }

        /* === BUTTON === */
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

        /* === ALERT === */
        .alert {
            background: #fee2e2;
            color: #b91c1c;
            border-left: 4px solid #dc2626;
            padding: 0.7rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            text-align: left;
        }

        /* === FOOTER === */
        .text-muted {
            font-size: 0.85rem;
            color: #9ca3af;
            margin-top: 1.5rem;
        }

        /* === ANIMATION === */
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
    </style>
</head>
<body>
    <div class="login-container">
        <h3>Login Admin</h3>
        <p class="subtitle">Masuk ke sistem informasi kebencanaan</p>

        {{-- 🔴 Error validation --}}
        @if ($errors->any())
            <div class="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 🔴 Error login --}}
        @if (session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-primary">Masuk</button>
        </form>

        <p class="text-muted">&copy; {{ date('Y') }} Sistem Informasi Kebencanaan</p>
    </div>
</body>
</html>
