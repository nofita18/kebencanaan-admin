<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Bina Desa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            background:
                linear-gradient(rgba(0, 48, 90, 0.6), rgba(0, 48, 90, 0.6)),
                url('{{ asset('assets-admin/images/auth/desaaaaaa.jpg') }}') no-repeat center center/cover;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 60px;
            background: rgba(0, 0, 0, 0.3);
        }

        header h1 {
            font-size: 22px;
            font-weight: 600;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 6px;
            transition: 0.3s;
        }

        nav a:hover {
            background: white;
            color: #003060;
        }

        .hero {
            text-align: center;
            margin-top: 100px;
        }

        .hero h2 {
            font-size: 50px;
            letter-spacing: 2px;
            font-weight: 700;
        }

        .hero p {
            font-size: 20px;
            margin-top: 10px;
            font-weight: 300;
        }

        .buttons {
            margin-top: 40px;
        }

        .buttons a {
            text-decoration: none;
            background: white;
            color: #003060;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            margin: 0 10px;
            transition: 0.3s;
        }

        .buttons a:hover {
            background: #00bfff;
            color: white;
        }

        footer {
            text-align: center;
            padding: 15px;
            font-size: 14px;
            background: rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <header>
        <h1>Sistem Bina Desa</h1>
        <nav>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Daftar User</a>
        </nav>
    </header>

    <div class="hero">
        <h2>Sistem Bina Desa</h2>
        <p>Kebencanaan dan Tanggap Darurat</p>

        <div class="buttons">
            <a href="{{ route('login') }}">Masuk Sekarang</a>
            <a href="{{ route('register') }}">Daftar User</a>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Sistem Bina Desa. Semua hak dilindungi.
    </footer>
</body>

</html>
