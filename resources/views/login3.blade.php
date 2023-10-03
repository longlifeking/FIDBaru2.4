<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FID </title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .container {
            height: 100vh;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .login-box{
            width: 500px;
            border: solid 1px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        form div{
            margin-bottom: 15px;
        }
        .input-group{
            width: 100%;
            position: relative;
        }
    
        .fa-eye{
            position: absolute;
            top: 50%;
            right: 3%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .input-group-text{
            width: 50px;
        }
        button:hover {
            opacity: 0.8;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="card-header text-center">
                <h3>Login</h3>
            </div>
            @if (session('status'))
            <div class="alert alert-danger"> {{ session('message') }}</div>
            @endif
            <form action="" method="post">
                @csrf
                <div>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukan username anda" required>
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan password anda" required>
                        <span class="input-group-text" id="togglePassword">
                        <i class="fas fa-eye-slash" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary form-control">Login</button>
                </div>
                <div class="text-center">
                    Don't have an account? <a href="register">Sign Up</a>
                </div>   
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            function togglePasswordVisibility() {
                let inputType = $('#password').attr('type');
                let newType = inputType === 'password' ? 'text' : 'password';
                let iconClass = inputType === 'password' ? 'fa-eye' : 'fa-eye-slash';

                $('#password').attr('type', newType);
                $('#togglePassword i').removeClass('fa-eye-slash fa-eye').addClass(iconClass);
            }

            $('#togglePassword').on('click', function (e) {
                e.preventDefault();
                togglePasswordVisibility();
            });
        });
    </script>
</body>
</html>
