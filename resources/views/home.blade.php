@extends('layouts.master')

@section('content')
    <div>
        @if ($errors->any() || session('error'))
            <div class="my-4 alert alert-danger" role="alert">
                <i class="fa-solid fa-triangle-exclamation"></i>
                @if ($errors->any() || session('error'))
                    Houve um erro na sua aplicação.
                @endif
            </div>
        @endif
        <h1>Bem vindo ao Notes!</h1>
        <hr>
        @if(count($notes) === 0)
            <div class="d-flex flex-column gap-2 justify-content-center align-items-center">
                <h3>Você não tem notas</h3>
                <a href="{{ route('note.create') }}" class="btn btn-lg btn-primary">Criar nota</a>
            </div>
            <hr>
            <br>
        @else
            <div class="d-flex justify-content-end">
                <a href="{{ route('note.create') }}" class="btn btn-primary">Nova nota</a>
            </div>
            @foreach($notes as $note)
                @include('note')
            @endforeach
            <div class="d-flex justify-content-center flex-column gap-4">
                {{ $notes->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
