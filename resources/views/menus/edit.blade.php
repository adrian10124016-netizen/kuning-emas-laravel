@extends('layouts.app')

@section('title', 'Edit Menu — KUNING EMAS')

@push('styles')
<style>
    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-size: 0.74rem;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 6px;
    }

    .form-control {
        width: 100%;
        background-color: var(--bg-charcoal);
        border: 1px solid var(--border-gold);
        color: var(--cream);
        padding: 10px 12px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--gold-light);
    }

    .alert-err {
        background-color: rgba(224, 122, 122, 0.12);
        border: 1px solid var(--danger);
        color: #F2A7A7;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 0.88rem;
    }
</style>
@endpush

@section('content')
    <div class="card" style="max-width: 680px; margin: 0 auto;">
        <h1 class="card-title">Edit Menu: {{ $menu->name }}</h1>

        @if ($errors->any())
            <div class="alert-err">
                <ul style="margin-left: 18px;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('menus.update', $menu) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Nama Menu</label>
                <input type="text" id="name" name="name" value="{{ old('name', $menu->name) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Harga (Rp)</label>
                <input type="number" id="price" name="price" min="1000" step="1000" value="{{ old('price', $menu->price) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="form-control">{{ old('description', $menu->description) }}</textarea>
            </div>

            @if (!empty($menu->image))
                <div class="form-group">
                    <label>Foto Saat Ini</label>
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" style="width: 140px; height: 95px; object-fit: cover; border: 1px solid var(--border-gold); display: block;">
                </div>
            @endif

            <div class="form-group">
                <label for="image">Ganti Foto Menu (Opsional)</label>
                <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp" class="form-control">
            </div>

            <div class="form-group">
                <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" name="is_available" value="1" {{ old('is_available', $menu->is_available) ? 'checked' : '' }}>
                    <span>Tersedia di Showcase</span>
                </label>
            </div>

            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <button type="submit" class="btn btn-solid">Simpan Perubahan</button>
                <a href="{{ route('menus.index') }}" class="btn">Batal</a>
            </div>
        </form>
    </div>
@endsection