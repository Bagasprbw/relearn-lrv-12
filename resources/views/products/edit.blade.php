@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="bg-light rounded p-4">
        <h4>Edit Produk | {{$products->name}}</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.products.update', $products->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Nama Produk</label>
                <input type="text" name="name" value="{{$products->name}}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    @foreach ($categories as $kategori)
                        <option value="{{ $kategori->id }}" {{ $kategori->id == $products->kategori_id ? 'selected' : '' }}>
                            {{ $kategori->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="price">Harga</label>
                <input type="number" name="price" value="{{$products->price}}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="image">Gambar</label>
                <input type="file" name="image" class="form-control">
                @if ($products->image)
                    <img src="{{ asset('storage/products/' . $products->image) }}" alt="{{ $products->name }}" class="mt-2" style="max-width: 200px;">
                @endif
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
