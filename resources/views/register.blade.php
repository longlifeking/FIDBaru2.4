<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style3.css') }}">
    <title>Registration</title>
</head>
<body>
        <div class="container1">
            <h2> Form Registration </h2>
            <form method="post" action="{{route("registerprocess")}}">
              <div>
                @if (session('status'))
                <div class="alert alert-danger">{!! session('message') !!}</div>
                @endif
                @csrf
              </div>
              <label for="username">Username:</label>
              <input type="text" id="username" name="username" placeholder="Isi nickname anda" required>
              <label for="email">Email:</label>
              <input type="text" id="email" name="email"placeholder ="Harus menggunakan email pertamina" required>
              <label for="username">Handphone:</label>
              <input type="text" id="phonenumber" name="phonenumber" placeholder="Isi nomer anda" required>
              <div>
                <label for="password" class="form-label">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password anda" required>
                        <span class="input-group-text" id="togglePassword">
                        <i class="fas fa-eye-slash" aria-hidden="true"></i></span>
                    </div>
              </div>
              <label for="text">Alamat</label>
              <input type="text" id="address" name="address" placeholder="alamat anda sekarang" </required>
              <input type="submit" value="Submit">
              <div class="signup-link">
                <p class="bottom-text">If you have account? <a href="login">Login</a></p>
              </div>
            </form>
        </div>
</body>
<script src="{{ asset('js/mainjs.js') }}"></script>
</html>