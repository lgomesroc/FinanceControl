@extends('layouts.app')

@section('content')
    <h1>Editar Alerta</h1>

    <form action="{{ route('alerts.update', $alert) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="message">Mensagem</label>
            <input type="text" name="message" id="message" value="{{ old('message', $alert->message) }}" required>
        </div>
        <div>
            <label for="user_id">ID do Usuário</label>
            <input type="text" name="user_id" id="user_id" value="{{ old('user_id', $alert->user_id) }}" required>
        </div>
        <button type="submit">Atualizar Alerta</button>
    </form>
@endsection
