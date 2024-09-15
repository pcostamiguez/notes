@extends('layouts.master')
@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-form">
            <h4 class="text-primary text-center">Entre com as suas credenciais</h4>
            <hr>
            <div class="m-4 alert alert-danger" role="alert">
                <b>Ops!</b> Login e/ou senha inválidos.
            </div>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">E-mail</label>
                    <input type="email" placeholder="Informe o seu e-mail institucional" class="form-control"
                           id="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Senha</label>
                    <input placeholder="Informe a sua senha" type="password" class="form-control" id="password">
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
