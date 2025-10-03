<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Berhasil</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f0f2f5; }
    .card {
      max-width: 400px;
      margin: 60px auto;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
    }
    h2 { color:#2e7d32; }
    a { display:inline-block; margin-top:15px; color:#1976d2; text-decoration:none; }
    a:hover { text-decoration: underline; }
  </style>
</head>
<body>
<div class="card">
  <h2>Login Berhasil 🎉</h2>
  <p>Halo, <strong>{{ $username }}</strong>! Anda berhasil login karena username dan password sama.</p>
  <a href="/auth">Kembali ke Login</a>
</div>
</body>
</html>
