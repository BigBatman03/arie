{{-- filepath: c:\Users\micha\Desktop\laravel\arie_app\resources\views\training\result.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wynik - ARIE</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header class="topbar">
        <a class="brand" href="{{ route('dashboard') }}">ARIE</a>
    </header>
    <main class="container" style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
        <div class="card" style="text-align: center; max-width: 500px; padding: 3rem;">
            <h1 style="color: var(--primary);">Trening Zakończony!</h1>
            
            <p style="font-size: 1.2rem; margin: 1rem 0;">
                Ukończyłeś moduł: <strong>{{ $module->name ?? 'Trening' }}</strong>
            </p>

            <div class="kpi" style="justify-content: center; margin: 2rem 0;">
                <div class="kpi__item">
                    <div class="kpi__label">Twój Wynik</div>
                    <div class="kpi__value" style="font-size: 3.5rem;">
                        {{ $score }} <span style="font-size: 1.5rem; color:#888;">/ {{ $maxScore }}</span>
                    </div>
                </div>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn--primary">Wróć do kokpitu</a>
        </div>
    </main>
</body>
</html>