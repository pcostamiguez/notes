@extends('layouts.master')

@section('content')
    <div>
        <h1>Bem vindo ao Notes!</h1>
        <hr>
        <div class="d-flex flex-column gap-2 justify-content-center align-items-center">
            <h3>Você não tem notas</h3>
            <button class="btn btn-primary">Criar nota</button>
        </div>
        <hr>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary">Nova nota</button>
        </div>
        <br>
        <div class="d-flex flex-column gap-4 bg-body-tertiary border border-black p-3 rounded-3">
            <div>
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Título da nota</h5>
                        <p class="fst-italic">Criado em 00/00/0000 00:00:00</p>
                    </div>
                    <div>
                        <button class="btn btn-warning">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                        <button class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
                <hr>
                <div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur dignissimos ducimus eos exercitationem fuga nihil nisi perspiciatis quas sapiente veritatis! Architecto, atque corporis cumque deserunt fugiat iste quibusdam reprehenderit veniam!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
