<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>-->
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->

    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.min.css">
    
    <title>Laporan FID | @yield('title')</title>
</head>
<body>
  <div class="main d-flex flex-column justify-between">
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand " href="/dashboard">
          <h4>Projects Zona 1</h4></a>
          <div class="row">
            <div class="name">
              <div class="bell">
                <a href="{{('notification.nav')}}" class="notification-icon">
                  <i class="fas fa-bell"></i> <!-- Ini adalah ikon lonceng -->
                  <span class="notification-count">0</span>
                </a>
                   
              </div>            
             <div class="name1"><h5>{{ Auth::user()->username }}</h5></div>
                
            </div>
        </div>
               
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </nav> 
    <div class="body-content h-100 mt-5">
      <div class="row g-0 h-100">
        <div class="sidebar collapse d-lg-block po" id="navbarTogglerDemo3">
          @if (Auth::user()->role_id == 1)
          <a href="/dashboard" @if(request()->route()->uri =='dashboard') class="active" @endif>Total Persetujuan FID ZONA 1</a>
          <a href="/fid-search" @if(request()->route()->uri =='fid-search')class="active" @endif>FID</a>
          <a href="/afe-awal"@if(request()->route()->uri =='afe-awal')class="active" @endif>AFE</a>
          <a href="/flowline"@if(request()->route()->uri =='flowline')class="active" @endif>Flowline</a>
          <a href="/Pengguna" @if(request()->route()->uri =='Pengguna')class="active" @endif>Pengguna</a>
          <a href="/profile1" @if(request()->route()->uri =='profile1')class="active" @endif>Profile</a>
          <a href="/logout">Logout</a>
          @else
          <a href="/dashboard2" @if(request()->route()->uri =='dashboard2')class="active" @endif>Total Persetujuan FID ZONA 1</a>
          <a href="/afe-awal1"@if(request()->route()->uri =='afe-awal1')class="active" @endif>AFE</a>
          <a href="/flowline"@if(request()->route()->uri =='flowline')class="active" @endif>Flowline</a>
          <a href="/profile1" @if(request()->route()->uri =='profile1')class="active" @endif>Profile</a>
          <a href="/logout">Logout</a> 
          @endif
        </div>
      </div>
    </div>
    <div class="content p-3 col-10 mt-3">
      @yield('content')
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 
  <script>
    // Misalnya, Anda memiliki kode yang menerima notifikasi baru dan ingin menambahkan satu ke angka notifikasi.
    function tambahkanNotifikasi() {
        var notificationCountElement = $('.notification-count');
        var currentCount = parseInt(notificationCountElement.text());
        notificationCountElement.text(currentCount + 1);
    }

    // Anda dapat memanggil fungsi tambahkan Notifikasi() ketika notifikasi baru tiba.
    // Contoh:
    // tambahkanNotifikasi();
</script>
</body>
</html>