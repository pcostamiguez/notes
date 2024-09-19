@extends('layouts.master')

@section('content')
    <h3>Lista de Notas</h3>
    <hr>
    @isset($notes)
        @foreach($notes as $note)
            @include('note')
        @endforeach
        <div class="d-flex justify-content-center flex-column gap-4">
            {{ $notes->links('pagination::bootstrap-5') }}
        </div>
    @else
        <p>Nenhuma nota encontrada.</p>
    @endisset
@endsection
