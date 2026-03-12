{{-- filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\training\understanding.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Trening 3: Rozumienie</title>
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
        <h1>Moduł 3: Rozumienie emocji</h1>
        <div class="content">
            <p class="muted">
              Przed Tobą opisy różnych sytuacji, w których bohaterowie doświadczają odmiennych stanów emocjonalnych.
              Przy każdym opisie wybierz <strong>jaką emocję odczuwają bohatarowie</strong>.
            </p>
            <p class="muted" style="margin-top:-.25rem">
              Cel ćwiczenia: rozwijanie umiejętności identyfikacji i werbalizacji emocji, rozróżniania emocji o podobnym charakterze,
              rozumienia zależności przyczynowo-skutkowych między wydarzeniami a emocjami oraz rozpoznawania emocji złożonych lub mieszanych.
            </p>
          </div>
          

        <div id="game-root" class="game-container">
            <div id="progress" class="muted" style="margin-bottom:1rem"></div>

            <div class="scenario-card">
                <span id="scenario-title" class="scenario-title">Sytuacja</span>
                <div id="scenario-text" class="scenario-text">Ładowanie...</div>
            </div>

            <div id="options-area" class="options-grid"></div>

            <div id="feedback" class="feedback-box hide"></div>

            <button id="next-btn" class="btn btn--primary btn-check hide">Dalej</button>
        </div>

        <div id="results-area" class="hide text-center" style="margin-top:2rem">
            <h3>Koniec modułu 3!</h3>
            <p id="final-score" style="font-size:1.5rem; margin:1rem 0"></p>
            <a href="{{ route('training.management') }}" class="btn btn--primary">Przejdź do Modułu 4</a>
        </div>
    </section>
</main>

<script>
    const exercises = @json($exercises);
    let currentIndex = 0;
    let totalScore = 0;

    const els = {
        root: document.getElementById('game-root'),
        progress: document.getElementById('progress'),
        text: document.getElementById('scenario-text'),
        options: document.getElementById('options-area'),
        feedback: document.getElementById('feedback'),
        nextBtn: document.getElementById('next-btn'),
    };

    function init() {
        if(!exercises || !exercises.length) {
            els.root.innerHTML = "<p>Brak danych w bazie dla tego modułu.</p>";
            return;
        }
        load();
        els.nextBtn.onclick = next;
    }

    function load() {
        if(currentIndex >= exercises.length) return finish();

        const ex = exercises[currentIndex];

        els.progress.textContent = `Pytanie ${currentIndex+1} / ${exercises.length}`;
        els.text.textContent = ex.text ?? '';
        els.feedback.classList.add('hide');
        els.nextBtn.classList.add('hide');

        renderOptions(ex);
    }

    function renderOptions(ex) {
        els.options.innerHTML = '';
        (ex.options || []).forEach(opt => {
            const btn = document.createElement('button');
            btn.className = 'option-btn';
            btn.textContent = opt.text;
            btn.onclick = () => check(opt, ex);
            els.options.appendChild(btn);
        });
    }

    function check(selectedOpt, ex) {
        const btns = els.options.querySelectorAll('button');
        btns.forEach(b => b.disabled = true);

        const isCorrect = Number(selectedOpt.is_correct) === 1;
        if(isCorrect) totalScore++;

        // podświetlenia
        btns.forEach(b => {
            const opt = (ex.options || []).find(o => o.text === b.textContent);
            if(opt && Number(opt.is_correct) === 1) b.classList.add('selected-correct');
        });
        if(!isCorrect) {
            Array.from(btns).find(b => b.textContent === selectedOpt.text)?.classList.add('selected-wrong');
        }

        els.feedback.innerHTML = `
            <p><strong>${isCorrect ? 'Dobrze!' : 'Nie do końca.'}</strong></p>
            <p class="muted" style="margin-top:0.5rem; font-size:0.9rem">${ex.explanation || ''}</p>
        `;
        els.feedback.classList.remove('hide');
        els.nextBtn.classList.remove('hide');
    }

    function next() {
        currentIndex++;
        load();
    }

    async function finish() {
        els.root.classList.add('hide');
        document.getElementById('results-area').classList.remove('hide');
        document.getElementById('final-score').textContent = `Wynik: ${totalScore} / ${exercises.length}`;

        try {
            await fetch("{{ route('training.understanding.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ score: totalScore, max_score: exercises.length })
            });
        } catch(e) { console.error(e); }
    }

    init();
</script>
</body>
</html>