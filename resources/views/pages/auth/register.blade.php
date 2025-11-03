<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #e8f0fe;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 380px;
        }
        h2 { text-align: center; color: #2563eb; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { font-size: 14px; color: #333; display: block; margin-bottom: 5px; }
        input {
            width: 100%; padding: 10px; border: 1px solid #d1d5db;
            border-radius: 8px; font-size: 14px;
        }
        input:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 4px #93c5fd; }
        button {
            width: 100%; background: #2563eb; color: white; border: none;
            padding: 10px; border-radius: 8px; cursor: pointer;
        }
        button:hover { background: #1d4ed8; }
        .footer-text { text-align: center; margin-top: 15px; font-size: 14px; }
        .footer-text a { color: #2563eb; text-decoration: none; }
    </style>
</head>
<body>
<div class="register-container">
    <h2>Daftar User</h2>

    @if ($errors->any())
        <div style="background:#fee2e2;color:#b91c1c;padding:10px;border-radius:6px;margin-bottom:10px;">
            <ul style="margin:0;padding-left:20px;">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Daftar</button>
    </form>

    <div class="footer-text">
        Sudah punya User? <a href="{{ route('login') }}">Login</a>
    </div>
</div>
</body>
</html>
