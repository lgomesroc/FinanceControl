@extends('layouts.app')

@section('content')
    <h1>Usuários</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary">Criar Usuário</a>

    <ul>
        @foreach($users as $user)
            <li>
                <strong>{{ $user->name }}</strong> - {{ $user->email }}
                <a href="{{ url("users/$user->id/edit") }}" class="btn btn-warning">Editar</a>
                <form action="{{ url("users/$user->id") }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
