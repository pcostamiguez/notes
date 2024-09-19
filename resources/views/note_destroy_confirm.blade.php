@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column gap-4 bg-white border border-black p-3 my-3 rounded-3">
        <div class="container">
            <h1 class="text-danger">Realmente deseja deletar a nota #{{ $note->id }}?</h1>
            <h3>Título da nota: {{ $note->title }}</h3>
            <p class="text-danger">ATENÇÃO! Essa ação <b>Não</b> poderá ser desfeita.</p>
            <hr>
            <div class="d-flex justify-content-center align-items-center gap-4">
                <a class="btn btn-secondary" href="{{ route('note.index') }}">Cancelar</a>

                <!-- Substituição do link por formulário para exclusão -->
                <form action="{{ route('note.destroy', Crypt::encrypt($note->id)) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Sim, Desejo Apagar!
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
