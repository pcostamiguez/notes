@extends('layouts.master')
@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="login-form">
            <h4 class="text-primary text-center">Entre com as suas credenciais</h4>
            <hr>
            @if ($errors->any())
                <div class="m-4 alert alert-danger" role="alert">
                    <b>Ops!</b> Corrija os erros.
                </div>
            @endif
            <form action="{{ route('auth.authenticate') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">E-mail</label>
                    <input type="text" placeholder="Informe o seu e-mail institucional"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Senha</label>
                    <input placeholder="Informe a sua senha" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <a href="/forgot-password">Esqueci a senha</a>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
