<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Services\Utils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('note_list', [
            'notes' => DB::table('notes')->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('note_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo "criação";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View | RedirectResponse
    {
        $decryptedId = Utils::decryptId($id);

        if ($decryptedId instanceof RedirectResponse) {
            return $decryptedId;
        }

        try {
            $note = Note::find($decryptedId)->first();
            return view('note_form', ['note' => $note]);
        } catch (\Exception $e) {
            Log::error(" NoteController - method: edit (find): " . $e->getMessage());
            return redirect()->route('home.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = Utils::decryptId($id);
        echo "update do id: $id";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
