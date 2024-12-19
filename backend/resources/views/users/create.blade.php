@extends('layouts.app')

@section('content')
    <h1>Criar Usuário</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirmação de Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <button type="submit">Criar Usuário</button>
    </form>
@endsection
