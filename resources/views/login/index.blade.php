<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Woodland Login</title>
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

    .login-container {
      background-color: rgba(255, 255, 255, 0.9);
      border: 2px solid #8B4513;
      border-radius: 10px;
      padding: 30px;
      width: 300px;
      box-shadow: 0 0 15px rgba(0,0,0,0.3);
    }

    .login-container h2 {
      text-align: center;
      color: #5C3317;
      margin-bottom: 20px;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #A0522D;
      border-radius: 5px;
    }

    .login-container button {
      background-color: #A0522D;
      color: white;
      border: none;
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    .login-container button:hover {
      background-color: #8B4513;
    }

    .login-container p {
      text-align: center;
      font-size: 0.9em;
      margin-top: 15px;
      color: #555;
    }
    #roleSelect{
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #A0522D;
      border-radius: 5px;
    }
  </style>
</head>
<body>
@if (session('loginError'))
    <div style="color: red; text-align: center; margin-bottom: 10px;">
        {{ session('loginError') }}
    </div>
@endif

  <div class="login-container">
    <h2>Login Woodland</h2>
<form method="POST" action="/login">
    @csrf
    <select name="role" id="roleSelect" required>
        <option value="pelanggans">Login as Pelanggan</option>
        <option value="admin">Login as Admin</option>
    </select>

    <input type="text" name="email" placeholder="Email atau Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Log In</button>
</form>

<p id="signupText">Don't have an account? <a href="register">Sign Up</a> </p>

  </div>

</body>

<script>
    document.getElementById('roleSelect').addEventListener('change', function () {
        const selectedRole = this.value;
        const signupText = document.getElementById('signupText');

        if (selectedRole === 'admin') {
            signupText.style.display = 'none';
        } else {
            signupText.style.display = 'block';
        }
    });
</script>
</html>
