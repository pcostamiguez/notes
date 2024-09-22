@extends('layouts.master')

@section('content')
    <h3>{{ isset($note) ? 'Editar Nota ID: ' . $note->id : 'Nova Nota' }}</h3>
    <hr>
    <form action="{{ isset($note) ? route('note.update', ['id' => Crypt::encrypt($note->id)]) : route('note.store') }}" method="POST">
        @csrf
        @isset($note)
            @method('PUT')
        @endisset
        <div class="container">
            @if ($errors->any() || session('error'))
                <div class="my-4 alert alert-danger" role="alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    @if ($errors->any() || session('error'))
                        Houve um erro na sua aplicação.
                    @endif
                </div>
            @endif
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Título</label>
                <input type="text"
                       class="form-control @error('title') is-invalid @enderror"
                       id="title"
                       name="title" value="{{ old('title', $note->title ?? '') }}" required>
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body" class="form-label fw-bold">Corpo da nota</label>
                <textarea name="body"
                          id="body"
                          class="form-control @error('body') is-invalid @enderror"
                          cols="30"
                          rows="10"
                          required>{{ old('body', $note->body ?? '') }}</textarea>
                @error('body')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-success" type="submit">
                    <span class="d-none spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span class="visually-hidden" role="status">Loading...</span>
                    Salvar
                </button>
            </div>
        </div>
    </form>
@endsection
