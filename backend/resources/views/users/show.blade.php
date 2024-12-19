@extends('layouts.app')

@section('content')
    <h1>Detalhes do Usuário</h1>

    <p><strong>Nome:</strong> {{ $user->name }}</p>
    <p><strong>E-mail:</strong> {{ $user->email }}</p>
    <p><strong>Criado em:</strong> {{ $user->created_at }}</p>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
