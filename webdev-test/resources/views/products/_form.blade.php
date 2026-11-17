@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Harga</label>
    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="3" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
