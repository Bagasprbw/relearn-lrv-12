@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')
    <div class="bg-light rounded p-4">
        <h6 class="mb-4">Sugeng rawuh ning dashboard Pak/Bu {{ Auth::check() ? Auth::user()->name : '' }}</h6>
    </div>

@endsection
