<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Logowanie — ARIE</title>
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
            <a class="nav__btn nav__btn--primary" href="{{ route('login') }}">Logowanie</a>
            <a class="nav__btn" href="{{ route('register') }}">Rejestracja</a>
        @endauth
      </nav>
    </header>

    <main class="container">
      <section class="card" aria-labelledby="login-title">
        <h1 id="login-title">Zaloguj się</h1>

        @if(session('error'))
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
                {{ session('error') }}
            </div>
        @endif
        
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background:#fee; color:#c00; padding:10px; border-radius:5px; margin-bottom:15px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form class="form" method="POST" action="{{ route('login') }}">
          @csrf
          <label class="field">
            <span class="field__label">E-mail</span>
            <input class="field__input" type="email" name="email" value="{{ old('email') }}" required />
          </label>

          <label class="field">
            <span class="field__label">Hasło</span>
            <input class="field__input" type="password" name="password" required />
          </label>

          <button class="btn btn--primary" type="submit">Zaloguj</button>

          <div class="form__hint">
            Nie masz konta? <a class="linklike" href="{{ route('register') }}">Załóż je</a>
          </div>
        </form>
      </section>
    </main>
  </body>
</html>
