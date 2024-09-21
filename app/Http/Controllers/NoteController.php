<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Services\Utils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $notes = Note::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('note_list', compact('notes'));
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
    public function store(NoteRequest $request): RedirectResponse
    {
        try {
            // Obter usuário logado
            $user = auth()->user();

            // Verificar se o usuário está autenticado
            if (!$user) {
                return redirect()->route('login')->with(['error' => 'Você precisa estar logado para criar uma nota.']);
            }

            // Preencher os campos e salvar a nota usando o relacionamento
            $user->notes()->create($request->validated());

            // Retornar resposta ao usuário com mensagem de sucesso
            return redirect()->route('note.index')->with('success', 'Nota salva com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao processar formulário: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao enviar o formulário.');
        }
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
            $note = Note::all()->findOrFail($decryptedId);
            return view('note_form', ['note' => $note]);
        } catch (\Exception $e) {
            Log::error(" NoteController - method: edit (find): " . $e->getMessage());
            return redirect()->route('home.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, string $id): RedirectResponse
    {
        $decryptedId = Utils::decryptId($id);

        if ($decryptedId instanceof RedirectResponse) {
            return $decryptedId;
        }

        try {
            $note = Note::findOrFail($decryptedId);
            $note->update($request->validated());
            return redirect()->route('note.index')->with(['success' => 'Nota atualizada com sucesso!']);
        } catch (\Exception $e) {
            Log::error(" NoteController - method: update (update): " . $e->getMessage());
            return redirect()->route('note.index')->with('error', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyConfirm(string $id): View|RedirectResponse
    {
        $decryptedId = Utils::decryptId($id);

        if ($decryptedId instanceof RedirectResponse) {
            return $decryptedId;
        }
        $note = Note::all()->findOrFail($decryptedId);
        return view('note_destroy_confirm', ['note' => $note]);
    }

    public function destroy(string $id): RedirectResponse
    {
        $decryptedId = Utils::decryptId($id);
        try {
            $note = Note::all()->findOrFail($decryptedId);
            $note->delete();
            return redirect()->route('note.index')->with(['success' => 'Nota apagada com sucesso!']);
        }catch (\Exception $e){
            Log::error(" NoteController - method: destroy (destroy): " . $e->getMessage());
            return redirect()->route('note.index')->with('error', $e->getMessage());
        }
    }
}
