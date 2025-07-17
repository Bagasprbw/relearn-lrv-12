@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')
    <div class="bg-light rounded p-4">
        <h4>Tambah Admin</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="admin_store" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="name">Phone</label>
                <input type="tel" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="name">Alamat</label>
                <textarea name="address" class="form-control" id=""></textarea>
            </div>
            <div class="mb-3">
                <label for="price">Buat Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="/data_admins" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
