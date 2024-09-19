@extends('layouts.master')

@section('content')
    <h3>Nova nota</h3>
    <hr>
    <form action="">
        @csrf
        <div class="container">
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Título</label>
                <input type="text" placeholder="Título da nota"
                       class="form-control @error('title') is-invalid @enderror"
                       id="title"
                       name="title" value="{{ old('title') }}" required>
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
                          required></textarea>
                @error('body')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </form>
@endsection
