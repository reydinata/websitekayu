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

    #roleSelect {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #A0522D;
      border-radius: 5px;
    }

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.6);
    }

    .modal-content {
      background-color: #fff;
      margin: 15% auto;
      padding: 20px;
      border: 2px solid #f44336;
      width: 80%;
      max-width: 400px;
      border-radius: 10px;
      text-align: center;
      position: relative;
    }

    .modal-content img {
      width: 80px;
      margin-bottom: 10px;
    }

    .modal-content h3 {
      color: #f44336;
      margin-bottom: 10px;
    }

    .close-btn {
      background-color: #f44336;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }

    .close-btn:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>

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

  <!-- Modal for login error -->
  @if (session('loginError'))
  <div id="errorModal" class="modal">
    <div class="modal-content">
      <img src="https://cdn-icons-png.flaticon.com/512/463/463612.png" alt="Error Icon">
      <h3>Login Gagal</h3>
      <p>Username atau Password salah</p>
      <button class="close-btn" onclick="closeModal()">Tutup</button>
    </div>
  </div>
  @endif

  <script>
    document.getElementById('roleSelect').addEventListener('change', function () {
        const selectedRole = this.value;
        const signupText = document.getElementById('signupText');

        signupText.style.display = (selectedRole === 'admin') ? 'none' : 'block';
    });

    function closeModal() {
      document.getElementById("errorModal").style.display = "none";
    }

    // Show modal if loginError session exists
    @if (session('loginError'))
      window.onload = function() {
        document.getElementById("errorModal").style.display = "block";
      };
    @endif
  </script>

</body>
</html>
