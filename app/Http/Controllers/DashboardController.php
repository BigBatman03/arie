<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {
        // Logujemy wejście na panel główny TYLKO jeśli użytkownik jest zalogowany
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'module' => 'dashboard',
                'type' => 'visit'
            ]);
        }

        return view('dashboard');
    }
}
