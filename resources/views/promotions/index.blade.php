@extends('layouts.app')

@section('title', 'Kelola Promo — KUNING EMAS')

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
        grid-template-columns: minmax(290px, 380px) 1fr;
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
        vertical-align: top;
    }

    table.data-table th {
        color: var(--gold);
        font-size: 0.72rem;
        letter-spacing: 0.14em;
        text-transform: uppercase;
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
            <h1 class="page-title">Kelola Promo &amp; Voucher</h1>
            <p style="color: var(--cream-muted); font-size: 0.9rem;">
                Atur kode promo, potongan diskon, dan status aktif penawaran KUNING EMAS.
            </p>
        </div>
        <a href="{{ route('menus.index') }}" class="btn">Kembali ke Kelola Menu</a>
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
            <h2 class="card-title">Tambah Promo</h2>
            <form action="{{ route('promotions.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="title">Judul Promo</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" required placeholder="Contoh: Royal Dinner Inauguration">
                </div>

                <div class="form-group">
                    <label for="code">Kode Promo</label>
                    <input type="text" id="code" name="code" value="{{ old('code') }}" class="form-control" required placeholder="Contoh: EMAS15">
                </div>

                <div class="form-group">
                    <label for="discount_percent">Diskon (%)</label>
                    <input type="number" id="discount_percent" name="discount_percent" min="1" max="90" value="{{ old('discount_percent', 15) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi (Opsional)</label>
                    <textarea id="description" name="description" rows="3" class="form-control" placeholder="Syarat atau keterangan promo...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                        <span>Aktifkan Promo</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-solid">Simpan Promo</button>
            </form>
        </div>

        <div class="card">
            <h2 class="card-title">Daftar Promo</h2>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Promo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($promotions as $promotion)
                            <tr>
                                <td>
                                    <form action="{{ route('promotions.update', $promotion) }}" method="POST" style="display: flex; flex-direction: column; gap: 8px;">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="title" value="{{ $promotion->title }}" class="form-control" required>
                                        <div style="display: grid; grid-template-columns: 1fr 110px; gap: 8px;">
                                            <input type="text" name="code" value="{{ $promotion->code }}" class="form-control" required>
                                            <input type="number" name="discount_percent" min="1" max="90" value="{{ $promotion->discount_percent }}" class="form-control" required>
                                        </div>
                                        <input type="text" name="description" value="{{ $promotion->description }}" class="form-control" placeholder="Deskripsi...">
                                        <div>
                                            <button type="submit" class="btn" style="padding: 6px 12px; font-size: 0.7rem;">Update</button>
                                        </div>
                                    </form>
                                </td>
                                <td style="white-space: nowrap;">
                                    <form action="{{ route('promotions.toggle', $promotion) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn" style="padding: 6px 12px; font-size: 0.7rem;">
                                            {{ $promotion->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('promotions.destroy', $promotion) }}" method="POST" onsubmit="return confirm('Hapus promo ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 0.7rem;">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="color: var(--cream-muted);">Belum ada data promo.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection