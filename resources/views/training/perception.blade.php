{{-- filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\training\perception.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Trening 1: Percepcja</title>
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
        <h1>Moduł 1: Percepcja emocji</h1>

        <div class="content">
          <p class="muted">
            Wskaż, którą emocję przejawiają osoby na zamieszczonych fotografiach.
          </p>
          <p class="muted" style="margin-top:-.25rem">
            Cel ćwiczenia: doskonalenie rozumienia mechanizmów emocji, rozwijanie umiejętności wyciągania wniosków z doświadczeń
            oraz kształtowanie krytycznego myślenia.
          </p>
        </div>

        <div id="game-root" class="game-container">
            <div id="progress" class="muted"></div>
            <!-- Zmieniamy kontener, aby domyślnie miał stałą wysokość lub spinner -->
            <div id="media-display" style="min-height: 400px; display: flex; align-items: center; justify-content: center;"></div>
            <div id="question-text" style="font-size:1.2rem; margin:1rem 0;"></div>
            <div id="options-area" class="options-grid"></div>
            <div id="feedback" class="feedback-msg"></div>
        </div>
        
        <div id="results-area" class="hide text-center">
            <h3>Gratulacje! Ukończyłeś moduł.</h3>
            <p id="final-score" style="margin: 1rem 0; font-size:1.5rem"></p>
            <a href="{{ route('training.usage') }}" class="btn btn--primary">Przejdź do Modułu 2</a>
        </div>
      </section>
    </main>

    <script>
        // Dane wstrzykiwane z kontrolera PHP
        window.__ARIE__ = window.__ARIE__ || {};
        window.__ARIE__.exercises = @json($exercises);
        window.__ARIE__.storeUrl = @json(route('training.perception.store'));
        window.__ARIE__.csrf = @json(csrf_token());
        window.__ARIE__.nextUrl = @json(route('training.usage'));
    </script>
    <script src="{{ asset('js/training-perception.js') }}"></script>
</body>
</html>