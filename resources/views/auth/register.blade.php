<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Rejestracja — ARIE</title>
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
      <section class="card" aria-labelledby="register-title">
        <h1 id="register-title">Rejestracja</h1>

        @if ($errors->any())
            <div style="background:#fee; color:#c00; padding:10px; border-radius:5px; margin-bottom:15px;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form class="form" method="POST" action="{{ route('register') }}">
          @csrf
          <label class="field">
            <span class="field__label">Imię</span>
            <input class="field__input" type="text" name="name" value="{{ old('name') }}" required />
          </label>

          <label class="field">
            <span class="field__label">E-mail</span>
            <input class="field__input" type="email" name="email" value="{{ old('email') }}" required />
          </label>

          <label class="field">
            <span class="field__label">Hasło</span>
            <input class="field__input" type="password" name="password" required minlength="6" />
          </label>
          
          <button class="btn btn--primary" type="submit">Utwórz konto</button>

          <div class="form__hint">
            Masz już konto? <a class="linklike" href="{{ route('login') }}">Zaloguj się</a>
          </div>
        </form>
      </section>
    </main>
  </body>
</html>
