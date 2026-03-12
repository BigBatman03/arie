{{-- filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\profile.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil — ARIE</title>
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
      <section class="card">
        <div class="dash-head">
          <div><h1 id="profile-title">Profil</h1></div>
        </div>

        <div class="grid grid--2">
            <section class="panel" aria-labelledby="p-basic">
              <div class="panel__head">
                <h2 id="p-basic">Podstawowe informacje</h2>
              </div>
  
              <div class="kpi">
                <div class="kpi__item">
                  <div class="muted kpi__label">Imię</div>
                  <div class="kpi__value" id="p-name">{{ $user->name }}</div>
                </div>
                <div class="kpi__item">
                  <div class="muted kpi__label">E-mail</div>
                  <div class="kpi__value" id="p-email">{{ $user->email }}</div>
                </div>
                <div class="kpi__item">
                  <div class="muted kpi__label">Start</div>
                  <div class="kpi__value" id="p-since">{{ $user->created_at->format('d.m.Y') }}</div>
                </div>
                <div class="kpi__item">
                  <div class="muted kpi__label">Aktywności (7 dni)</div>
                  <div class="kpi__value" id="p-7d">{{ $lastWeekActivityCount ?? 0 }}</div>
                </div>
              </div>
            </section>

          <!-- Progress Bars -->
          <section class="panel">
            <div class="panel__head">
              <h2> Twój Postęp </h2>
            </div>
            <div class="bars" role="list">
              <!-- Perception -->
              <div class="bar">
                <div class="bar__head"><span>Percepcja</span><span class="muted">{{ $progress['perception']['count'] ?? 0 }} prób</span></div>
                <div class="bar__track"><div class="bar__fill" style="width:{{ $progress['perception']['percentage'] ?? 0 }}%"></div></div>
              </div>
              <!-- Usage -->
              <div class="bar">
                <div class="bar__head"><span>Wykorzystanie</span><span class="muted">{{ $progress['usage']['count'] ?? 0 }} prób</span></div>
                <div class="bar__track"><div class="bar__fill" style="width:{{ $progress['usage']['percentage'] ?? 0 }}%"></div></div>
              </div>
              <!-- Understanding -->
              <div class="bar">
                <div class="bar__head"><span>Rozumienie</span><span class="muted">{{ $progress['understanding']['count'] ?? 0 }} prób</span></div>
                <div class="bar__track"><div class="bar__fill" style="width:{{ $progress['understanding']['percentage'] ?? 0 }}%"></div></div>
              </div>
              <!-- Management -->
              <div class="bar">
                <div class="bar__head"><span>Zarządzanie</span><span class="muted">{{ $progress['management']['count'] ?? 0 }} prób</span></div>
                <div class="bar__track"><div class="bar__fill" style="width:{{ $progress['management']['percentage'] ?? 0 }}%"></div></div>
              </div>
              <!-- SSEIT -->
              <div class="bar">
                <div class="bar__head"><span>Test SSEIT</span><span class="muted">{{ $sseitCount }} wykonano</span></div>
                <div class="bar__track"><div class="bar__fill bar__fill--accent2" style="width:{{ $sseitCount > 0 ? 100 : 0 }}%"></div></div>
              </div>
            </div>
          </section>
        </div>

        <!-- SSEIT Results -->
        <section class="panel" style="margin-top: 1rem">
          <div class="panel__head">
            <h2 id="p-sseit">Ostatni wynik SSEIT</h2>
            @if($lastSseit)
                <span class="muted">Data: {{ $lastSseit->created_at->format('Y-m-d') }}</span>
            @endif
          </div>

          @if($lastSseit)
              <div class="grid grid--3">
                <div class="mini">
                   <div class="muted mini__label">Percepcja</div>
                   <div class="mini__value">{{ $lastSseit->perception }} / {{ $lastSseit->max_total ? round($lastSseit->max_total * 0.3) : '??' }}</div> 
                </div>
                <div class="mini">
                   <div class="muted mini__label">Wykorzystanie</div>
                   <div class="mini__value">{{ $lastSseit->use_emotions }} / {{ $lastSseit->max_total ? round($lastSseit->max_total * 0.27) : '??' }}</div>
                </div>
                <div class="mini">
                   <div class="muted mini__label">Zarządzanie sobą</div>
                   <div class="mini__value">{{ $lastSseit->manage_own }} / {{ $lastSseit->max_total ? round($lastSseit->max_total * 0.27) : '??' }}</div>
                </div>
              </div>
              <div class="mini" style="margin-top: 0.8rem">
                  <div class="muted mini__label">Suma</div>
                  <div class="mini__value">{{ $lastSseit->total_score }} / {{ $lastSseit->max_total }}</div>
              </div>
          @else
              <p class="muted">Brak wyników. <a href="{{ route('sseit') }}">Wykonaj test</a></p>
          @endif
        </section>

        <!-- History -->
        <section class="panel" style="margin-top: 1rem">
          <div class="panel__head">
            <h2 id="p-history">Historia aktywności</h2>
          </div>
          <div class="timeline">
            @forelse($activities as $act)
                <div class="timeline__item">
                    <div class="timeline__dot" aria-hidden="true"></div>
                    <div class="timeline__body">
                      <div class="timeline__title">
                          @if($act->type == 'login') Zalogowano
                          @elseif($act->type == 'visit') Odwiedzono
                          @elseif($act->type == 'completion') Ukończono trening
                          @elseif($act->type == 'sseit_result') Wynik SSEIT
                          @else {{ $act->type }} @endif
                      </div>
                      <div class="timeline__meta">
                          {{ $act->module }} • {{ $act->created_at->diffForHumans() }} 
                          @if($act->meta_data) ({{ $act->meta_data }}) @endif
                      </div>
                    </div>
                </div>
            @empty
                <p class="muted">Brak aktywności.</p>
            @endforelse
          </div>
        </section>
      </section>
    </main>
  </body>
</html>