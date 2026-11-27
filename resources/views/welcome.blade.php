@extends('layouts.app')

@section('title', 'KUNING EMAS — Fine Dining Nasi Kuning')

@push('styles')
<style>
    .main-content {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    .main-content > .container {
        max-width: 100%;
        padding: 0;
    }

    .inner {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 24px;
    }

    .hero {
        text-align: center;
        padding: 88px 0 72px;
        border-bottom: 1px solid var(--border-gold);
        background: radial-gradient(circle at 50% 20%, rgba(223, 190, 90, 0.11), transparent 65%);
    }

    .eyebrow {
        color: var(--gold);
        font-size: 0.8rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    h1.hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2.8rem, 6vw, 4.5rem);
        font-weight: 600;
        letter-spacing: 0.06em;
        color: var(--cream);
        line-height: 1.1;
        margin-bottom: 20px;
    }

    h1.hero-title span {
        color: var(--gold);
    }

    .hero-desc {
        max-width: 620px;
        margin: 0 auto 34px;
        color: var(--cream-muted);
        font-size: 1rem;
    }

    .menu-section {
        padding: 76px 0 84px;
        border-bottom: 1px solid var(--border-gold);
    }

    .section-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .section-header h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.4rem;
        color: var(--gold);
        font-weight: 600;
        margin-bottom: 8px;
    }

    .section-header p {
        color: var(--cream-muted);
        font-size: 0.95rem;
    }

    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 36px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border-gold);
    }

    .category-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .pill {
        padding: 8px 16px;
        border: 1px solid var(--border-gold);
        background-color: rgba(23, 20, 16, 0.7);
        color: var(--cream-muted);
        text-decoration: none;
        font-size: 0.76rem;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        transition: all 0.2s ease;
    }

    .pill:hover,
    .pill.active {
        border-color: var(--gold);
        background-color: var(--gold);
        color: var(--bg-charcoal);
        font-weight: 600;
    }

    .search-form {
        display: flex;
        gap: 8px;
    }

    .search-input {
        background-color: var(--bg-card);
        border: 1px solid var(--border-gold);
        color: var(--cream);
        padding: 9px 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem;
        min-width: 210px;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--gold-light);
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
    }

    .menu-card {
        background: linear-gradient(180deg, rgba(29, 24, 18, 0.96) 0%, var(--bg-card) 100%);
        border: 1px solid var(--border-gold);
        box-shadow: 0 16px 36px rgba(0, 0, 0, 0.42);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    }

    .menu-card:hover {
        transform: translateY(-4px);
        border-color: var(--gold-light);
        box-shadow: 0 22px 44px rgba(0, 0, 0, 0.55);
    }

    .menu-img {
        width: 100%;
        height: 190px;
        object-fit: cover;
        border-bottom: 1px solid var(--border-gold);
        display: block;
    }

    .menu-body {
        padding: 24px 28px 28px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex: 1;
    }

    .menu-category {
        font-size: 0.72rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 10px;
    }

    .menu-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.65rem;
        color: var(--cream);
        font-weight: 600;
        line-height: 1.25;
        margin-bottom: 12px;
    }

    .menu-desc {
        color: var(--cream-muted);
        font-size: 0.92rem;
        margin-bottom: 24px;
    }

    .menu-price {
        border-top: 1px solid var(--border-gold);
        padding-top: 14px;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--gold-light);
    }

    .reservation-section {
        padding: 76px 0 88px;
        background: radial-gradient(circle at 50% 85%, rgba(212, 175, 55, 0.08), transparent 65%);
    }

    .reservation-box {
        max-width: 720px;
        margin: 0 auto;
        background: linear-gradient(180deg, rgba(29, 24, 18, 0.96) 0%, var(--bg-card) 100%);
        border: 1px solid var(--border-gold);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.45);
        padding: 36px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
        margin-bottom: 18px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 0.74rem;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        background-color: var(--bg-charcoal);
        border: 1px solid var(--border-gold);
        color: var(--cream);
        padding: 11px 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.9rem;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--gold-light);
    }

    .alert-res {
        background-color: rgba(212, 175, 55, 0.12);
        border: 1px solid var(--gold);
        color: var(--gold-light);
        padding: 14px 18px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }

    .alert-err {
        background-color: rgba(217, 119, 119, 0.12);
        border: 1px solid var(--danger);
        color: #F2A7A7;
        padding: 14px 18px;
        margin-bottom: 20px;
        font-size: 0.88rem;
    }
</style>
@endpush

@section('content')
    <section class="hero">
        <div class="inner">
            <div class="eyebrow">Heritage Culinary Experience</div>
            <h1 class="hero-title">Warisan Rasa <span>Kuning Emas</span></h1>
            <p class="hero-desc">
                Menghadirkan kehangatan nasi kuning nusantara dalam sentuhan presentasi fine dining modern—berpadu rempah pilihan, bahan premium, dan suasana hangat penuh keanggunan.
            </p>
            <div style="display: flex; justify-content: center; gap: 14px; flex-wrap: wrap;">
                <a href="#menu" class="btn">Jelajahi Menu</a>
                <a href="#reservasi" class="btn btn-solid">Reservasi Meja</a>
            </div>
        </div>
    </section>

    <section id="menu" class="menu-section">
        <div class="inner">
            <div class="section-header">
                <h2>Signature Menu</h2>
                <p>Disajikan segar langsung dari dapur Kuning Emas</p>
            </div>

            <div class="filter-bar">
                <div class="category-pills">
                    <a href="{{ url('/') }}#menu" class="pill {{ empty($selectedCategory) ? 'active' : '' }}">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ url('/?category=' . urlencode($category)) }}#menu"
                           class="pill {{ $selectedCategory === $category ? 'active' : '' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>

                <form action="{{ url('/') }}#menu" method="GET" class="search-form">
                    @if (!empty($selectedCategory))
                        <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    @endif
                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           placeholder="Cari nasi kuning, wagyu..."
                           class="search-input">
                    <button type="submit" class="btn" style="padding: 9px 18px;">Cari</button>
                </form>
            </div>

            <div class="menu-grid">
                @forelse ($menus as $menu)
                    <a href="{{ route('menus.show', $menu) }}" style="text-decoration: none; color: inherit; display: flex;">
                        <article class="menu-card" style="width: 100%;">
                            @if (!empty($menu->image))
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="menu-img">
                            @endif
                            <div class="menu-body">
                                <div>
                                    <div class="menu-category">{{ $menu->category }}</div>
                                    <h3 class="menu-title">{{ $menu->name }}</h3>
                                    <p class="menu-desc">{{ $menu->description }}</p>
                                </div>
                                <div class="menu-price">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </div>
                            </div>
                        </article>
                    </a>
                @empty
                    <p class="menu-desc">Tidak ada menu yang cocok dengan filter atau pencarian saat ini.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="reservasi" class="reservation-section">
        <div class="inner">
            <div class="section-header">
                <h2>Reservasi Meja</h2>
                <p>Pesan meja Anda untuk pengalaman bersantap malam di KUNING EMAS</p>
            </div>

            <div class="reservation-box">
                @if (session('reservation_success'))
                    <div class="alert-res">{{ session('reservation_success') }}</div>
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

                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf

                    <div class="form-grid">
                        <div>
                            <label for="guest_name">Nama Lengkap</label>
                            <input type="text" id="guest_name" name="guest_name" value="{{ old('guest_name') }}" class="form-control" required placeholder="Contoh: Raka Pratama">
                        </div>
                        <div>
                            <label for="guest_phone">No. WhatsApp / Telepon</label>
                            <input type="text" id="guest_phone" name="guest_phone" value="{{ old('guest_phone') }}" class="form-control" required placeholder="081234567890">
                        </div>
                    </div>

                    <div class="form-grid">
                        <div>
                            <label for="reservation_date">Tanggal Kedatangan</label>
                            <input type="date" id="reservation_date" name="reservation_date" value="{{ old('reservation_date', date('Y-m-d')) }}" class="form-control" required>
                        </div>
                        <div>
                            <label for="seating_time">Sesi / Jam</label>
                            <select id="seating_time" name="seating_time" class="form-control" required>
                                @foreach (['12:00 WIB (Lunch Seating)', '17:30 WIB (Early Dinner)', '19:30 WIB (Prime Dinner)', '21:00 WIB (Late Supper)'] as $slot)
                                    <option value="{{ $slot }}" {{ old('seating_time') === $slot ? 'selected' : '' }}>{{ $slot }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="guest_count">Jumlah Tamu</label>
                            <input type="number" id="guest_count" name="guest_count" min="1" max="30" value="{{ old('guest_count', 2) }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes">Catatan Khusus (Opsional)</label>
                        <textarea id="notes" name="notes" rows="3" class="form-control" placeholder="Perayaan ulang tahun, meja sudut tenang, alergi kacang...">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-solid">Kirim Reservasi</button>
                </form>
            </div>
        </div>
    </section>
@endsection