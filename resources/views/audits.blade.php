@extends('layouts.master')
@section('content')
    <h1>Auditoria</h1>
    <hr>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th scope="col">Data</th>
            <th scope="col">Usuário</th>
            <th scope="col">Requisição</th>
            <th scope="col">Status</th>
            <th scope="col">URL</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($audits as $audit)
            <tr>
                <td>{{ $audit->id }}</td>
                <td class="text-muted">{{ $audit->created_at->format('d/m/Y H:i:s') }}</td>
                <td>{{ $audit->user_email }}</td>
                <td class="
                    @if($audit->method == 'GET') text-primary
                    @elseif($audit->method == 'POST') text-secondary
                    @elseif($audit->method == 'PUT') text-warning
                    @elseif($audit->method == 'PATCH') text-warning
                    @elseif($audit->method == 'DELETE') text-danger
                    @endif
                ">
                    {{ $audit->method }}
                </td>
                <td class="{{ $audit->status === 'success' ? 'text-success' : 'text-danger' }}">{{ $audit->status }}</td>
                <td>{{ $audit->url }}</td>
                <td>
                    <a href="{{ route('note.auditDetail', ['id' => Crypt::encrypt($audit->id)]) }}">Ver</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $audits->links('pagination::bootstrap-5') }}
@endsection
