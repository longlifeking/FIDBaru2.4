@extends('layout.mainlayout')
@section('title','Edit Password')
@section('name')
@endsection
@section('content')
<div id="app">
    <div class="main-wrapper">
        <div class="main-content">
            <div class="container">
                <form method="post" action="/rubah-user-password/{{$Penggunaall->slug}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card mt-5">
                        <div class="card-header">
                            <h3>Edit Password</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <div class="alert-title">
                                        <h4>Whoops!</h4>
                                    </div>
                                    There are some problems with your input.
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                            </div>
                            <div>
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                                </div>
                            </div>
                         </div>
                        <div class="card-footer">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword()
    {
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Kata Sandi Tidak Cocok");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    $(document).ready(function () {
        // Fungsi untuk mengganti visibilitas kata sandi dan ikon mata
        function togglePasswordVisibility(inputId, toggleId) {
            let inputElement = document.getElementById(inputId);
            let toggleElement = document.getElementById(toggleId);
            if (inputElement.type === "password") {
                inputElement.type = "text";
                toggleElement.classList.remove("fa-eye");
                toggleElement.classList.add("fa-eye-slash");
            } else {
                inputElement.type = "password";
                toggleElement.classList.remove("fa-eye-slash");
                toggleElement.classList.add("fa-eye");
            }
        }

       // Handle click event on eye icon
       document.getElementById("togglePassword").addEventListener("click", function() {
            togglePasswordVisibility('password', 'togglePassword');
        });

        document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
            togglePasswordVisibility('confirm_password', 'toggleConfirmPassword');
        });
    });
</script>
@endsection
