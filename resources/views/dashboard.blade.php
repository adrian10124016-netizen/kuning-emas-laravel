@extends('layouts.app')

@section('title', 'Dashboard — KUNING EMAS')

@section('content')
    <div class="card">
        <h1 class="card-title">Selamat Datang, {{ Auth::user()->name }}</h1>
        <p style="color: var(--cream-muted); margin-bottom: 20px;">
            Anda sudah berhasil masuk ke panel manajemen KUNING EMAS.
        </p>
        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <a href="{{ route('menus.index') }}" class="btn btn-solid">Kelola Menu</a>
            <a href="{{ route('reservations.index') }}" class="btn">Daftar Reservasi</a>
        </div>
    </div>
@endsection