@extends('layouts.master')
@section('content')
    <h1>Log #{{ $audit->id }}</h1>
    <hr>
    <table class="table table-bordered">
        <tr>
            <td class="w-25 fw-bold">Data do evento</td>
            <td>{{ $audit->created_at->format('d/m/Y H:i:s') }}</td>
        </tr>
        <tr>
            <td class="w-25 fw-bold">Em</td>
            <td>{{ $audit->created_at->diffForHumans() }}</td>
        </tr>
        <tr>
            <td class="w-25 fw-bold">Usuário</td>
            <td>{{ $audit->user_email }}</td>
        </tr>
        <tr>
            <td class="w-25 fw-bold">IP</td>
            <td>{{ $audit->ip }}</td>
        </tr>
        <tr>
            <td class="w-25 fw-bold">Informação enviada</td>
            <td>
                @foreach($audit->sended_info as $key => $value)
                    @if(is_array($value))
                        {{ $key }}:
                        @foreach($value as $subKey => $subValue)
                            @if(is_array($subValue))
                                {{ $subKey }}: [ {{ implode(', ', $subValue) }} ]<br>
                            @else
                                {{ $subKey }}: {{ $subValue }}<br>
                            @endif
                        @endforeach
                    @else
                        <b>{{ $key }}</b>: {{ $value }}<br>
                    @endif
                @endforeach
            </td>
        </tr>
        <tr>
            <td class="w-25 fw-bold">Método</td>
            <td>{{ $audit->method }}</td>
        </tr>
        <tr>
            <td class="w-25 fw-bold">Status da requisição</td>
            <td>{{ $audit->status == 'success' ? 'sucesso' : 'tentativa' }}</td>
        </tr>
        <tr>
            <td class="w-25 fw-bold">Página</td>
            <td>{{ $audit->url }}</td>
        </tr>
        <tr>
            <td class="w-25 fw-bold">Tempo de execução</td>
            <td>{{ $audit->execution_time }}</td>
        </tr>
    </table>
    <a class="btn btn-primary" href="{{ route('note.audit') }}">Voltar</a>
@endsection
