@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Perfil do Usuário</h1>
        <p><strong>Nome:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar Perfil</a>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Excluir Conta</button>
        </form>
    </div>
@endsection
