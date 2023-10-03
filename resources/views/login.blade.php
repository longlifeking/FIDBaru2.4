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
    <title>Login</title>
</head>
<body>
        <div class="container">
            <h2> Form Login </h2>
            <form method="post" action={{route("authentifikasi")}}>
            <div>
                @if (session('status'))
                <div class="alert alert-danger"> {{ session('message') }}</div>
                @endif
                @csrf
            </div>
              <label for="name">Username:</label>
              <input type="text" id="username" name="username" placeholder="Isi Username" required>
              <div>
                <label for="password" class="form-label">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan password anda" required>
                        <span class="input-group-text" id="togglePassword">
                        <i class="fas fa-eye-slash" aria-hidden="true"></i></span>
                    </div>
              </div>
              <input type="submit" value="Login">
              <div class="signup-link">
                <p class="bottom-text">Don't have an account? <a href="register">Sign up</a></p>
              </div>
            </form>
        </div>
    
</body>
<script src="{{ asset('js/mainjs.js') }}"></script>
</html>