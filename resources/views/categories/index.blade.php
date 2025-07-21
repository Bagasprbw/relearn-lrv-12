@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="bg-light rounded p-4">
        <h4>Daftar Kategori</h4>
         <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>
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
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                         <td >{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <form action="{{ route('dashboard.categories.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kategory ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
