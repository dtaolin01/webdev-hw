@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <h1 class="h3 mb-3">Tambah Produk</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        @include('products._form')
    </form>
@endsection
