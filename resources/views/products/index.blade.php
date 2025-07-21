@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')
    <div class="bg-light rounded p-4">
        <h4>Daftar Produk</h4>
         <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>
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
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>Rp {{ number_format($item->price) }}</td>
                        <td>
                            <form action="{{ route('dashboard.products.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            <a href="{{ route('dashboard.products.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
