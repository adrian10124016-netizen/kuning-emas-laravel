<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KUNING EMAS — Fine Dining Nasi Kuning')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-charcoal: #0E0C0A;
            --bg-card: #171410;
            --gold: #DFBE5A;
            --gold-light: #F0D682;
            --cream: #F7F3EA;
            --cream-muted: #CFC5B0;
            --border-gold: rgba(223, 190, 90, 0.30);
            --danger: #E07A7A;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-charcoal);
            background-image:
                radial-gradient(ellipse 85% 45% at 50% -5%, rgba(212, 175, 55, 0.14), transparent 70%),
                radial-gradient(circle at 85% 25%, rgba(166, 124, 55, 0.08), transparent 45%);
            color: var(--cream);
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.7;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1120px;
            width: 100%;
            margin: 0 auto;
            padding: 0 24px;
        }

        header.site-header {
            border-bottom: 1px solid var(--border-gold);
            padding: 18px 0;
            background-color: rgba(14, 12, 10, 0.92);
            backdrop-filter: blur(8px);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .nav-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.45rem;
            letter-spacing: 0.16em;
            color: var(--gold);
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: none;
            white-space: nowrap;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .nav-link {
            color: var(--cream-muted);
            text-decoration: none;
            font-size: 0.72rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 6px 2px;
            border-bottom: 1px solid transparent;
            white-space: nowrap;
            transition: color 0.2s ease, border-color 0.2s ease;
            background: transparent;
            border-top: none;
            border-left: none;
            border-right: none;
            cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--gold);
            border-bottom-color: var(--gold);
        }

        main.main-content {
            flex: 1;
            padding: 48px 0 72px;
        }

        .card {
            background: linear-gradient(180deg, rgba(28, 23, 17, 0.96) 0%, var(--bg-card) 100%);
            border: 1px solid var(--border-gold);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.45);
            padding: 28px;
        }

        .card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.7rem;
            color: var(--gold);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 9px 18px;
            border: 1px solid var(--gold);
            background: transparent;
            color: var(--gold);
            text-decoration: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn:hover {
            background-color: var(--gold);
            color: var(--bg-charcoal);
            font-weight: 600;
        }

        .btn-solid {
            background-color: var(--gold);
            color: var(--bg-charcoal);
            font-weight: 600;
        }

        .btn-solid:hover {
            background-color: var(--gold-light);
            border-color: var(--gold-light);
        }

        .btn-danger {
            border-color: var(--danger);
            color: var(--danger);
        }

        .btn-danger:hover {
            background-color: var(--danger);
            color: var(--bg-charcoal);
            font-weight: 600;
        }

        footer.site-footer {
            border-top: 1px solid var(--border-gold);
            padding: 24px 0;
            text-align: center;
            color: var(--cream-muted);
            font-size: 0.84rem;
            background-color: rgba(14, 12, 10, 0.85);
        }
    </style>
    @stack('styles')
</head>
<body>
    <header class="site-header">
        <div class="container nav-inner">
            <a href="{{ url('/') }}" class="brand">KUNING EMAS</a>
            <nav class="nav-links" aria-label="Navigasi Utama">
                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Showcase</a>
                <a href="{{ url('/') }}#menu" class="nav-link">Menu</a>
                <a href="{{ url('/') }}#reservasi" class="nav-link">Reservasi</a>
                <a href="{{ route('menus.index') }}" class="nav-link {{ request()->routeIs('menus.index') || request()->routeIs('menus.edit') ? 'active' : '' }}">Kelola Menu</a>
                <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">Kelola Kategori</a>
                <a href="{{ route('promotions.index') }}" class="nav-link {{ request()->routeIs('promotions.*') ? 'active' : '' }}">Kelola Promo</a>
                <a href="{{ route('reservations.index') }}" class="nav-link {{ request()->routeIs('reservations.*') ? 'active' : '' }}">Daftar Reservasi</a>

                @auth
                    <span class="nav-link" style="color: var(--gold); border-bottom-color: transparent; cursor: default;">
                        {{ Auth::user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            &copy; {{ date('Y') }} KUNING EMAS &mdash; Fine Dining Nasi Kuning Management.
        </div>
    </footer>
</body>
</html>