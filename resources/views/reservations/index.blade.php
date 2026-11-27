@extends('layouts.app')

@section('title', 'Manajemen Reservasi — KUNING EMAS')

@push('styles')
<style>
    .page-head {
        margin-bottom: 32px;
        border-bottom: 1px solid var(--border-gold);
        padding-bottom: 20px;
    }

    .page-head h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        color: var(--gold);
        font-weight: 600;
        margin-bottom: 6px;
    }

    .page-head p {
        color: var(--cream-muted);
        font-size: 0.94rem;
    }

    .toolbar {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        margin-bottom: 24px;
        padding-bottom: 18px;
        border-bottom: 1px solid var(--border-gold);
    }

    .status-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .pill {
        padding: 7px 14px;
        border: 1px solid var(--border-gold);
        background-color: rgba(14, 12, 10, 0.75);
        color: var(--cream-muted);
        text-decoration: none;
        font-size: 0.72rem;
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

    .search-box {
        display: flex;
        gap: 8px;
    }

    .search-input {
        background-color: var(--bg-charcoal);
        border: 1px solid var(--border-gold);
        color: var(--cream);
        padding: 8px 12px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.86rem;
        min-width: 210px;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--gold-light);
    }

    .res-table {
        width: 100%;
        border-collapse: collapse;
    }

    .res-table th {
        text-align: left;
        font-size: 0.72rem;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--gold);
        padding: 12px 10px;
        border-bottom: 1px solid var(--border-gold);
    }

    .res-table td {
        padding: 16px 10px;
        border-bottom: 1px solid rgba(223, 190, 90, 0.15);
        vertical-align: middle;
        font-size: 0.88rem;
    }

    .badge-status {
        display: inline-block;
        padding: 4px 10px;
        font-size: 0.7rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        border: 1px solid var(--gold);
        color: var(--gold-light);
        background-color: rgba(223, 190, 90, 0.08);
    }

    .select-status {
        background-color: var(--bg-charcoal);
        border: 1px solid var(--border-gold);
        color: var(--cream);
        padding: 7px 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.82rem;
    }

    .btn-sm {
        padding: 7px 12px;
        font-size: 0.68rem;
        letter-spacing: 0.12em;
    }

    .alert-ok {
        background-color: rgba(223, 190, 90, 0.12);
        border: 1px solid var(--gold);
        color: var(--gold-light);
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 0.88rem;
    }
</style>
@endpush

@section('content')
    <div class="page-head">
        <h1>Manajemen Reservasi</h1>
        <p>Pantau jadwal meja tamu, perbarui status kedatangan, dan kelola catatan khusus KUNING EMAS</p>
    </div>

    @if (session('success'))
        <div class="alert-ok">{{ session('success') }}</div>
    @endif

    <div class="card" style="overflow-x: auto;">
        <h2 class="card-title">Daftar Reservasi ({{ $reservations->count() }})</h2>

        <div class="toolbar">
            <div class="status-pills">
                @php
                    $statuses = ['Semua', 'Pending', 'Dikonfirmasi', 'Selesai', 'Dibatalkan'];
                    $currentStatus = $selectedStatus ?? request('status', 'Semua');
                @endphp
                @foreach ($statuses as $st)
                    <a href="{{ route('reservations.index', array_filter(['status' => $st !== 'Semua' ? $st : null, 'search' => $search ?? request('search')])) }}"
                       class="pill {{ $currentStatus === $st ? 'active' : '' }}">
                        {{ $st }}
                    </a>
                @endforeach
            </div>

            <form action="{{ route('reservations.index') }}" method="GET" class="search-box">
                @if (!empty($currentStatus) && $currentStatus !== 'Semua')
                    <input type="hidden" name="status" value="{{ $currentStatus }}">
                @endif
                <input type="text"
                       name="search"
                       value="{{ $search ?? request('search') }}"
                       placeholder="Cari nama, no. HP, sesi..."
                       class="search-input">
                <button type="submit" class="btn btn-sm">Cari</button>
            </form>
        </div>

        <table class="res-table">
            <thead>
                <tr>
                    <th>Tamu &amp; Kontak</th>
                    <th>Jadwal</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $res)
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: var(--cream);">{{ $res->guest_name }}</div>
                            <div style="font-size: 0.8rem; color: var(--cream-muted);">{{ $res->guest_phone }}</div>
                        </td>
                        <td>
                            <div style="color: var(--gold-light); font-weight: 500;">
                                {{ \Carbon\Carbon::parse($res->reservation_date)->translatedFormat('d M Y') }}
                            </div>
                            <div style="font-size: 0.8rem; color: var(--cream-muted);">{{ $res->seating_time }}</div>
                        </td>
                        <td style="white-space: nowrap; color: var(--cream); font-weight: 500;">
                            {{ $res->guest_count }} Tamu
                        </td>
                        <td style="color: var(--cream-muted); max-width: 240px;">
                            {{ $res->notes ?: '-' }}
                        </td>
                        <td>
                            <span class="badge-status">{{ strtoupper($res->status) }}</span>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column; gap: 8px; min-width: 155px;">
                                <form action="{{ route('reservations.updateStatus', $res) }}" method="POST" style="display: flex; gap: 6px;">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="select-status" style="flex: 1;">
                                        @foreach (['Pending', 'Dikonfirmasi', 'Selesai', 'Dibatalkan'] as $opt)
                                            <option value="{{ $opt }}" {{ $res->status === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm">Simpan</button>
                                </form>

                                <form action="{{ route('reservations.destroy', $res) }}" method="POST" onsubmit="return confirm('Hapus data reservasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="width: 100%;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--cream-muted); padding: 28px;">
                            Belum ada data reservasi yang sesuai.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection