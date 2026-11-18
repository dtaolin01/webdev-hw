@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h1 class="h3 mb-3">Edit Produk</h1>
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        @include('products._form')
    </form>
@endsection
