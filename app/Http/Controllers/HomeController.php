<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(): View
    {
        $user_notes = Auth::user()->makeHidden('password')->notes()->get()->toArray();

        return view('home', ['notes' => $user_notes]);
    }

    public function newNote()
    {
        echo "Nova nota";
    }
}

