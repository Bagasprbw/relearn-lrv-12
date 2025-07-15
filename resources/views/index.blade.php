<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AkuBakul</title>
</head>
<body>
    <i>pemilik sesi: {{ Auth::check() ? Auth::user()->name : 'Belum login' }}</i><br>
    <i>Role: {{ Auth::check() ? Auth::user()->role->name : 'Guest' }}</i><br>
    <i><a href="/logout">logout</a></i>
    <center>
        <h1>AkuBakul</h1>
        <h3>Selamat datang di AkuBakul</h3> <br>
        <p>Ayo dilarisi daganganku cah!! Tapi <a href="/login">login </a>sik lo cah, gen iso checkout. Nik urung due akun, <a href="/register">gawe akun</a> sek cah. Wes ngunu wae yo cah, Suwunnnn</p>
    </center>

</body>
</html>
