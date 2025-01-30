@extends('layouts.app')

@section('content')
    <h1>Detalhes do Alerta</h1>

    <p><strong>Mensagem:</strong> {{ $alert->message }}</p>
    <p><strong>Usuário:</strong> {{ $alert->user->name }}</p>
    <p><strong>Criado em:</strong> {{ $alert->created_at }}</p>

    <a href="{{ route('alerts.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
