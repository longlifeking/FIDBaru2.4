<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Email</title>
</head>
<body>
    <h2>Selamat datang di SISTEM INFORMASI FID ZONA 1</h2>
    <p>Terima kasih telah mendaftar. Sebelum memulai, harap verifikasi alamat email Anda dengan mengklik tautan di bawah ini:</p>
    <a href="{{ url('/verify-email/' . $token) }}">Verifikasi Email</a>

</body>
</html>
