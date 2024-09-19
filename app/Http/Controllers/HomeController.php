<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(): View
    {
        $user_notes = Auth::user()
            ->makeHidden('password')
            ->notes()
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        return view('home', ['notes' => $user_notes]);
    }

    public function newNote()
    {
        echo "Nova nota";
    }
}

