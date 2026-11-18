@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali input Anda:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
    <input type="text" id="name" name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $product->name ?? '') }}"
           required minlength="3" maxlength="255">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
    <input type="number" id="price" name="price"
           class="form-control @error('price') is-invalid @enderror"
           value="{{ old('price', $product->price ?? '') }}"
           required min="1" max="999999999" step="1">
    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea id="description" name="description" rows="3" maxlength="1000"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
    <div class="form-text">Opsional, maksimal 1000 karakter.</div>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
