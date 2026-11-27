@extends('layouts.app')

@section('title', 'Kelola Menu — KUNING EMAS')

@push('styles')
<style>
    .page-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 28px;
    }

    .page-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.3rem;
        color: var(--gold);
        font-weight: 600;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: minmax(290px, 390px) 1fr;
        gap: 24px;
        align-items: start;
    }

    @media (max-width: 900px) {
        .grid-2 {
            grid-template-columns: 1fr;
        }
    }

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

    .table-wrap {
        overflow-x: auto;
    }

    table.data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.88rem;
    }

    table.data-table th,
    table.data-table td {
        padding: 12px 14px;
        border-bottom: 1px solid var(--border-gold);
        text-align: left;
        vertical-align: middle;
    }

    table.data-table th {
        color: var(--gold);
        font-size: 0.72rem;
        letter-spacing: 0.14em;
        text-transform: uppercase;
    }

    .thumb-img {
        width: 64px;
        height: 48px;
        object-fit: cover;
        border: 1px solid var(--border-gold);
        display: block;
    }

    .alert-ok {
        background-color: rgba(223, 190, 90, 0.12);
        border: 1px solid var(--gold);
        color: var(--gold-light);
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 0.88rem;
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
    <div class="page-head">
        <div>
            <h1 class="page-title">Kelola Menu</h1>
            <p style="color: var(--cream-muted); font-size: 0.9rem;">
                Kelola hidangan KUNING EMAS beserta relasi kategorinya.
            </p>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="{{ route('categories.index') }}" class="btn">Kelola Kategori</a>
            <a href="{{ route('promotions.index') }}" class="btn btn-solid">Kelola Promo</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert-ok">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert-err">
            <ul style="margin-left: 18px;">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid-2">
        <div class="card">
            <h2 class="card-title">Tambah Menu Baru</h2>
            <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($categories->isEmpty())
                        <small style="color: var(--cream-muted); display: block; margin-top: 6px;">
                            Belum ada kategori. Buat dulu di <a href="{{ route('categories.index') }}" style="color: var(--gold);">Kelola Kategori</a>.
                        </small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name">Nama Menu</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required placeholder="Contoh: Nasi Kuning Truffle">
                </div>

                <div class="form-group">
                    <label for="price">Harga (Rp)</label>
                    <input type="number" id="price" name="price" min="1000" step="1000" value="{{ old('price') }}" class="form-control" required placeholder="150000">
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="3" class="form-control" placeholder="Deskripsi singkat hidangan...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Foto Menu (JPG / PNG / WEBP)</label>
                    <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp" class="form-control">
                </div>

                <div class="form-group">
                    <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_available" value="1" {{ old('is_available', '1') ? 'checked' : '' }}>
                        <span>Tersedia di Showcase</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-solid">Simpan Menu</button>
            </form>
        </div>

        <div class="card">
            <h2 class="card-title">Daftar Menu</h2>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Menu</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menus as $menu)
                            <tr>
                                <td>
                                    @if (!empty($menu->image))
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="thumb-img">
                                    @else
                                        <span style="color: var(--cream-muted); font-size: 0.78rem;">No Img</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: var(--cream);">{{ $menu->name }}</div>
                                    <div style="color: var(--cream-muted); font-size: 0.8rem;">{{ \Illuminate\Support\Str::limit($menu->description, 65) }}</div>
                                </td>
                                <td style="color: var(--gold); white-space: nowrap;">
                                    {{ $menu->category?->name ?? $menu->category }}
                                </td>
                                <td style="color: var(--gold-light); white-space: nowrap;">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </td>
                                <td>
                                    <form action="{{ route('menus.toggle', $menu) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn" style="padding: 5px 10px; font-size: 0.68rem;">
                                            {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                                        <a href="{{ route('menus.edit', $menu) }}" class="btn" style="padding: 5px 10px; font-size: 0.68rem;">Edit</a>
                                        <form action="{{ route('menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Hapus menu ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 0.68rem;">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="color: var(--cream-muted);">Belum ada data menu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection