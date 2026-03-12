{{-- filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\training\management.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Trening 4: Zarządzanie</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<header class="topbar">
    <a class="brand" href="{{ route('dashboard') }}" aria-label="Przejdź do panelu">
        <span class="brand__logo" aria-hidden="true"></span>
        <span class="brand__name">ARIE</span>
    </a>
    <nav class="nav" aria-label="Nawigacja">
        @auth
            <a class="nav__btn" href="{{ route('profile') }}">Mój Profil</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="nav__btn">Wyloguj</button>
            </form>
        @else
            <a class="nav__btn" href="{{ route('login') }}">Logowanie</a>
            <a class="nav__btn nav__btn--primary" href="{{ route('register') }}">Rejestracja</a>
        @endauth
    </nav>
</header>

<main class="container">
    <section class="card">
        <h1>Moduł 4: Zarządzanie emocjami</h1>
        <div class="content">
          <p class="muted">
            Dla każdego z opisów oceń <strong>4 możliwe reakcje</strong> w skali
            <strong>1 – „bardzo nieskuteczne”</strong> do <strong>5 – „bardzo skuteczne”</strong>, wskazując, które rozwiązanie
            najlepiej poprawia lub utrzymuje pozytywny nastrój bohatera.
          </p>
          <p class="muted" style="margin-top:-.25rem">
            Cel ćwiczenia: rozwijanie otwartości na różne emocje, świadome kierowanie uwagą na emocje (lub jej odwracanie),
            doskonalenie kontroli emocji własnych i cudzych poprzez rozumienie ich typowości, przejrzystości oraz wpływu,
            a także opanowywanie emocji negatywnych i wzmacnianie pozytywnych bez utraty informacji, jakie emocje przekazują.
          </p>
        </div>

        <div id="game-root" class="game-container">
            <div id="progress" class="muted" style="margin-bottom:1rem"></div>

            <div class="scenario-card">
                <span id="scenario-title" class="scenario-title"></span>
                <div id="scenario-text" class="scenario-text">Ładowanie...</div>
            </div>

            <form id="scales-container"></form>

            <div id="feedback" class="feedback-box hide"></div>

            <button id="check-btn" class="btn btn--primary btn-check" disabled>Sprawdź</button>
            <button id="next-btn" class="btn btn--primary btn-check hide">Dalej</button>
        </div>

        <div id="results-area" class="hide text-center" style="margin-top:2rem">
            <h3>Koniec modułu 4!</h3>
            <p id="final-score" style="font-size:1.5rem; margin:1rem 0"></p>
            <a href="{{ route('dashboard') }}" class="btn btn--primary">Wróć do panelu</a>
        </div>
    </section>
</main>

{{-- filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\training\management.blade.php --}}
{{-- ...existing code... --}}

<script>
    // filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\training\management.blade.php
    window.__ARIE__ = window.__ARIE__ || {};
    window.__ARIE__.exercises = @json($exercises);
    window.__ARIE__.storeUrl = @json(route('training.management.store'));
    window.__ARIE__.csrf = @json(csrf_token());
    window.__ARIE__.nextUrl = @json(route('dashboard'));
</script>
<script src="{{ asset('js/training-management.js') }}"></script>
</body>
</html>