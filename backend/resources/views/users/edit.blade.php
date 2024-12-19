@extends('layouts.app')

@section('content')
    <h1>Editar Usuário</h1>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div>
            <label for="password">Senha (deixe em branco para manter a atual)</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="password_confirmation">Confirmação de Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>
        <button type="submit">Atualizar Usuário</button>
    </form>
@endsection
