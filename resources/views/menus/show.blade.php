@extends('layouts.app')

@section('title', $menu->name . ' — KUNING EMAS')

@push('styles')
<style>
    .detail-card {
        max-width: 780px;
        margin: 0 auto;
        background: linear-gradient(180deg, rgba(29, 24, 18, 0.96) 0%, var(--bg-card) 100%);
        border: 1px solid var(--border-gold);
        box-shadow: 0 20px 44px rgba(0, 0, 0, 0.48);
        padding: 40px;
    }

    .detail-img {
        width: 100%;
        max-height: 380px;
        object-fit: cover;
        border: 1px solid var(--border-gold);
        margin-bottom: 28px;
        display: block;
    }

    .detail-cat {
        font-size: 0.78rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 10px;
    }

    .detail-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2.2rem, 4.5vw, 3.2rem);
        color: var(--cream);
        font-weight: 600;
        line-height: 1.15;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border-gold);
        margin-bottom: 20px;
    }

    .detail-price {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.9rem;
        font-weight: 700;
        color: var(--gold-light);
        padding-bottom: 22px;
        border-bottom: 1px solid var(--border-gold);
        margin-bottom: 24px;
    }

    .detail-desc {
        color: var(--cream-muted);
        font-size: 1rem;
        margin-bottom: 28px;
    }

    .kitchen-note {
        background-color: rgba(14, 12, 10, 0.75);
        border-left: 3px solid var(--gold);
        padding: 18px 20px;
        margin-bottom: 32px;
    }

    .kitchen-note-title {
        font-size: 0.72rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--gold);
        font-weight: 600;
        margin-bottom: 6px;
    }

    .kitchen-note p {
        color: var(--cream-muted);
        font-size: 0.9rem;
    }
</style>
@endpush

@section('content')
    <div class="detail-card">
        @if ($menu->image)
            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="detail-img">
        @endif

        <div class="detail-cat">{{ $menu->category }}</div>
        <h1 class="detail-title">{{ $menu->name }}</h1>
        <div class="detail-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
        <p class="detail-desc">{{ $menu->description }}</p>

        <div class="kitchen-note">
            <div class="kitchen-note-title">Catatan Penyajian Dapur</div>
            <p>Disajikan hangat saat pemesanan. Hubungi tim layanan kami apabila Anda memiliki preferensi tingkat kepedasan atau catatan alergi bahan tertentu.</p>
        </div>

        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <a href="{{ url('/') }}#menu" class="btn btn-solid">Kembali ke Menu</a>
            <a href="{{ route('menus.edit', $menu) }}" class="btn">Edit Hidangan</a>
        </div>
    </div>
@endsection