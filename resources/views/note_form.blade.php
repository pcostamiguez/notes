@extends('layouts.master')

@section('content')
    <h3>{{ isset($note) ? 'Editar Nota #' . $note->id : 'Nova Nota' }}</h3>
    <hr>
    <form action="{{ isset($note) ? route('note.update', ['id' => Crypt::encrypt($note['id'])]) : route('note.store') }}" method="POST">
        @csrf
        @isset($note)
            @method('PUT')
        @endisset
        <div class="container">
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
                <input class="btn btn-success" type="submit" value="Salvar">
            </div>
        </div>
    </form>
@endsection
