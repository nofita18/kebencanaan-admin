<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f0f2f5; }
    .card {
      max-width: 400px;
      margin: 60px auto;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h2 { text-align: center; margin-bottom: 20px; }
    label { display:block; margin-top:10px; }
    input {
      width: 100%;
      padding: 8px;
      margin-top:5px;
      border:1px solid #ccc;
      border-radius:4px;
    }
    button {
      width: 100%;
      margin-top: 15px;
      padding: 10px;
      border: none;
      border-radius: 6px;
      background: #1976d2;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover { background:#0d47a1; }
    .error {
      background: #ffe6e6;
      border:1px solid #ff4d4d;
      color:#b00020;
      padding:10px;
      border-radius:4px;
      margin-bottom:15px;
    }
  </style>
</head>
<body>
<div class="card">
  <h2>Form Login</h2>

  @if ($errors->any())
    <div class="error">
      <ul style="margin:0; padding-left:20px;">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="/auth/login">
    @csrf
    <label>Username</label>
    <input type="text" name="username" value="{{ old('username') }}">

    <label>Password</label>
    <input type="password" name="password" value="{{ old('password') }}">

    <button type="submit">Login</button>
  </form>
</div>
</body>
</html>
