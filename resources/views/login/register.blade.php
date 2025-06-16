<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Woodland Sign Up</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      background-image: url('{{ asset('sampelpicture/asset/hutan.jpg') }}');
      background-size: cover;
      background-position: center;
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .signup-container {
      background-color: rgba(255, 255, 255, 0.9);
      border: 2px solid #8B4513;
      border-radius: 10px;
      padding: 30px;
      width: 320px;
      box-shadow: 0 0 15px rgba(0,0,0,0.3);
    }

    .signup-container h2 {
      text-align: center;
      color: #5C3317;
      margin-bottom: 20px;
    }

    .signup-container input[type="text"],
    .signup-container input[type="email"],
    .signup-container input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #A0522D;
      border-radius: 5px;
    }

    .signup-container button {
      background-color: #A0522D;
      color: white;
      border: none;
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    .signup-container button:hover {
      background-color: #8B4513;
    }

    .signup-container p {
      text-align: center;
      font-size: 0.9em;
      margin-top: 15px;
      color: #555;
    }
  </style>
</head>
<body>

  <div class="signup-container">
    <h2>Sign Up Woodland</h2>

    <form method="POST" action="/register">
      @csrf

      <input type="text" name="nama_pelanggan" placeholder="Nama Lengkap" required>
      <input type="email" name="email_pelanggan" placeholder="Email" required>
      <input type="text" name="telepon_pelanggan" placeholder="No Telepon" required>
      <input type="password" name="password" placeholder="Password" required>

      <button type="submit">Sign Up</button>
    </form>

    <p>Sudah punya akun? <a href="/login">Login</a></p>
  </div>

</body>
</html>
