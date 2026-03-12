<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panel — ARIE</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
  </head>
  <body>
    <header class="topbar">
      <a class="brand" href="{{ route('dashboard') }}" aria-label="Przejdź do panelu">
        <span class="brand__logo" aria-hidden="true"></span>
        <span class="brand__name">ARIE</span>
      </a>

      <nav class="nav" aria-label="Nawigacja">
        @auth
            <!-- Widok dla zalogowanego -->
            <a class="nav__btn" href="{{ route('profile') }}">Mój Profil</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="nav__btn">Wyloguj</button>
            </form>
        @else
            <!-- Widok dla gościa -->
            <a class="nav__btn" href="{{ route('login') }}">Logowanie</a>
            <a class="nav__btn nav__btn--primary" href="{{ route('register') }}">Rejestracja</a>
        @endauth
      </nav>
    </header>

    <main class="container">
      <section aria-labelledby="dash-title">
        <div class="dash-head">
          <div>
            <h1 id="dash-title">Panel Główny</h1>
          </div>
        </div>

        <div class="tiles" role="list">
          <!-- Profil -->
          <a class="tile" href="{{ route('profile') }}" role="listitem">
            <div class="tile__icon" aria-hidden="true">👤</div>
            <div class="tile__body">
              <h2 class="tile__title">Profil</h2>
              <p class="tile__desc">Dane użytkownika, historia i postęp.</p>
            </div>
          </a>

          <!-- SSEIT -->
          <a class="tile" href="{{ route('sseit') }}" role="listitem">
            <div class="tile__icon" aria-hidden="true">🧪</div>
            <div class="tile__body">
              <h2 class="tile__title">Test SSEIT</h2>
              <p class="tile__desc">
                Samoopisowy test inteligencji emocjonalnej.
              </p>
            </div>
          </a>

          <!-- Trening 1 -->
          <a class="tile" href="{{ route('training.perception') }}" role="listitem">
            <div class="tile__icon" aria-hidden="true">👁️</div>
            <div class="tile__body">
              <h2 class="tile__title">Trening 1: Percepcja emocji</h2>
              <p class="tile__desc">Rozpoznawanie emocji u siebie i innych.</p>
            </div>
          </a>

          <!-- Trening 2 -->
          <a class="tile" href="{{ route('training.usage') }}" role="listitem">
            <div class="tile__icon" aria-hidden="true">🧠</div>
            <div class="tile__body">
              <h2 class="tile__title">Trening 2: Wykorzystanie emocji</h2>
              <p class="tile__desc">Emocje jako wsparcie myślenia i decyzji.</p>
            </div>
          </a>

          <!-- Trening 3 -->
          <a class="tile" href="{{ route('training.understanding') }}" role="listitem">
            <div class="tile__icon" aria-hidden="true">📚</div>
            <div class="tile__body">
              <h2 class="tile__title">Trening 3: Rozumienie emocji</h2>
              <p class="tile__desc">Nazywanie, przyczyny i dynamika emocji.</p>
            </div>
          </a>

          <!-- Trening 4 -->
          <a class="tile" href="{{ route('training.management') }}" role="listitem">
            <div class="tile__icon" aria-hidden="true">🧘</div>
            <div class="tile__body">
              <h2 class="tile__title">Trening 4: Zarządzanie emocjami</h2>
              <p class="tile__desc">
                Regulacja emocji i strategie radzenia sobie.
              </p>
            </div>
          </a>

          <!-- Wiedza (Link pozostawiony jako #, gdyż nie ma tego modułu w specyfikacji konwersji) -->
          <a class="tile" href="#" role="listitem" onclick="alert('Moduł edukacyjny dostępny wkrótce!'); return false;">
            <div class="tile__icon" aria-hidden="true">🧩</div>
            <div class="tile__body">
              <h2 class="tile__title">Podstawowa wiedza o emocjach</h2>
              <p class="tile__desc">
                Krótki moduł wprowadzający: czym są emocje i jak działają.
              </p>
            </div>
          </a>
        </div>
      </section>
    </main>

    <footer class="footer"></footer>
  </body>
</html>
