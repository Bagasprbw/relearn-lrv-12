<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AkuBakul</title>
</head>
<body>
    <i>pemilik sesi: {{ Auth::check() ? Auth::user()->name : 'Belum login' }}</i>
    @if(Auth::check() && Auth::user()->role_id == 3) | <a href="{{ route('profile.index') }}">Profile</a> @endif
    <br>
    <i>Role: {{ Auth::check() ? Auth::user()->role->name : 'Guest' }}</i><br>
    <i><a href="{{ route('logout') }}">logout</a></i>
    <center>
        <h1>AkuBakul</h1>
        <h3>Selamat datang di AkuBakul</h3> <br>
        <p>Ayo dilarisi daganganku cah!! Tapi <a href="{{ route('login.form') }}">login </a>sik lo cah, gen iso checkout. Nik urung due akun, <a href="{{ route('register.form') }}">gawe akun</a> sek cah. Wes ngunu wae yo cah, Suwunnnn</p> <br><hr>
        <h2>Daganganku</h2>

        @if($products->isEmpty())
            <p>Belum ada produk tersedia.</p>
        @else
            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jeneng Produk</th>
                        <th>Kategori</th>
                        <th>Rego</th>
                        <th>Rupo</th>
                        <th>Cekout le</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset('storage/products/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 100px;">
                                @else
                                    <i>Gambar ora ono!</i>
                                @endif
                            </td>
                            <td><button>Cek out</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </center>

</body>
</html>
