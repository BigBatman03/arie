{{-- filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\sseit.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8" />
    <title>Test SSEIT — ARIE</title>
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
        <h1>Test SSEIT</h1>
        <p class="muted">Oceń poniższe stwierdzenia w skali 1 (Zdecydowanie nie) do 5 (Zdecydowanie tak). 
            Pozycje oznaczone * są odwrócone (skala 5–1).</p>

        <form class="form" id="sseit-form">
            @forelse($questions as $index => $q)
                {{-- Używamy atrybutów modelu z bazy: subscale, is_reverse --}}
                <div class="sseit-q" 
                     data-subscale="{{ $q->subscale }}" 
                     data-reverse="{{ $q->is_reverse ? '1' : '0' }}">
                    <div class="sseit-q__text">{{ $index+1 }}. {{ $q->content }}</div>
                    <div class="sseit-scale">
                        @for($i=1; $i<=5; $i++) 
                            <label>
                                {{-- Kluczowe: name="answers[ID]" dla Laravel --}}
                                <input type="radio" name="answers[{{ $q->id }}]" value="{{ $i }}" required />
                                {{ $i }}
                            </label> 
                        @endfor
                    </div>
                </div>
            @empty
                <div style="padding: 2rem; text-align: center; background: #fff3cd; border-radius: 8px;">
                    <p><strong>Brak pytań w bazie danych.</strong></p>
                    <p>Uruchom: <code>php artisan db:seed --class=SseitSeeder</code></p>
                </div>
            @endforelse

            @if(isset($questions) && count($questions) > 0)
                <button id="submit-btn" class="btn btn--primary" type="submit" style="margin-top:1rem">Zapisz wynik</button>
            @endif
        </form>

        <div id="sseit-result" class="hide sseit-result" style="margin-top: 2rem; border-top: 1px solid var(--border); padding-top: 1rem;">
            <h2>Twoje Wyniki</h2>
            <div class="grid grid--2">
                <div class="panel">
                    <h3 class="muted" style="font-size:1rem">Wynik Całkowity</h3>
                    <div id="res-total" class="kpi__value" style="font-size:2rem; color:var(--accent)">0 / 0</div>
                </div>
                <div class="panel">
                    <ul class="list" style="padding:0; list-style:none;">
                        <li><strong>Percepcja emocji:</strong> <span id="res-perception">0</span></li>
                        <li><strong>Wykorzystanie emocji:</strong> <span id="res-usage">0</span></li>
                        <li><strong>Rozumienie (własne):</strong> <span id="res-own">0</span></li>
                        <li><strong>Zarządzanie (inni):</strong> <span id="res-others">0</span></li>
                    </ul>
                </div>
            </div>
            <div style="margin-top: 1.5rem; text-align: center;">
                <p class="muted">Twój wynik został zapisany w profilu.</p>
                <a href="{{ route('profile') }}" class="btn btn--primary">Przejdź do profilu</a>
            </div>
        </div>

      </section>
    </main>

 {{-- filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\sseit.blade.php --}}
{{-- ...existing code... --}}

<script>
    // filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\sseit.blade.php
    window.__ARIE__ = window.__ARIE__ || {};
    window.__ARIE__.sseitStoreUrl = @json(route('sseit.store'));
    window.__ARIE__.csrf = @json(csrf_token());
  </script>
  <script src="{{ asset('js/sseit.js') }}"></script>
  </body>
  </html>