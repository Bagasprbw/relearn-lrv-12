@extends('layouts.app')

@section('title', 'Data Admin')

@section('content')
    <div class="bg-light rounded p-4">
        <h4>Data Admin</h4>
         <a href="{{ route('dashboard.admins.create') }}" class="btn btn-primary mb-3">+ Tambah Admin</a>
         {{-- atau --}}
        {{-- <a href="/products/tambah" class="btn btn-primary mb-3">+ Tambah Produk</a> --}}


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

         <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->address }}</td>
                        <td>
                            {{-- <form action="/admin_delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')"> --}}
                            <form action="{{ route('dashboard.admins.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            {{-- <a href="{{ route('admins.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
