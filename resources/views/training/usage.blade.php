{{-- filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\training\usage.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Trening 2: Wykorzystanie</title>
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
        <h1>Moduł 2: Wykorzystanie emocji</h1>

        <div class="content">
          <p class="muted">
            W każdej historii oceń <strong>3 emocje</strong> w skali
            <strong>1 – „nie pomaga”</strong> do <strong>5 – „pomaga”</strong>, określając, na ile dana emocja może wspierać
            skuteczniejsze wykonanie zadania. Gdy uzupełnisz wszystkie trzy oceny, kliknij <strong>„Sprawdź”</strong>.
          </p>

          <p class="muted" style="margin-top:-.25rem">
            Cel ćwiczenia: wykorzystanie emocji do koncentrowania uwagi, wspierania pamięci i procesów poznawczych, zmiany perspektywy
            oraz zrozumienie roli emocji w rozwiązywaniu problemów i twórczym myśleniu.
          </p>
        </div>

        <div id="game-root" class="game-container">
            <div id="progress" class="muted" style="margin-bottom:1rem"></div>

             <div class="scenario-card">
                 <span id="scenario-title" class="scenario-title"></span>
                 <div id="scenario-text" class="scenario-text">Ładowanie...</div>
             </div>

             <div id="scales-container"></div>

             <div id="feedback" class="feedback-box hide"></div>

             <button id="check-btn" class="btn btn--primary btn-check" disabled>Sprawdź</button>
             <button id="next-btn" class="btn btn--primary btn-check hide">Dalej</button>
        </div>

        <div id="results-area" class="hide text-center" style="margin-top:2rem">
             <h3>Koniec modułu 2!</h3>
             <p id="final-score" style="font-size:1.5rem; margin:1rem 0"></p>

             <p class="muted" style="max-width: 720px; margin: 0 auto 1rem auto;">
               Cele ćwiczenia obejmują: wykorzystanie emocji do koncentrowania uwagi na kluczowych aspektach myślenia,
               traktowanie emocji jako narzędzia wspomagającego pamięć i procesy poznawcze, zmianę perspektywy poznawczej
               pod wpływem nastroju oraz zrozumienie, że właściwe emocje mogą sprzyjać rozwiązywaniu problemów i twórczemu myśleniu.
             </p>

             <a href="{{ route('training.understanding') }}" class="btn btn--primary">Przejdź do Modułu 3</a>
        </div>
      </section>
    </main>

    <script>
        // filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\training\usage.blade.php
        window.__ARIE__ = window.__ARIE__ || {};
        window.__ARIE__.exercises = @json($exercises);
        window.__ARIE__.storeUrl = @json(route('training.usage.store'));
        window.__ARIE__.csrf = @json(csrf_token());
        window.__ARIE__.nextUrl = @json(route('training.understanding'));
    </script>
    <script src="{{ asset('js/training-usage.js') }}"></script>
</body>
</html>