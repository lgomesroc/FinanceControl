@extends('layouts.app')

@section('content')
    <h1>Criar Alerta</h1>

    <form action="{{ route('alerts.store') }}" method="POST">
        @csrf
        <div>
            <label for="message">Mensagem</label>
            <input type="text" name="message" id="message" required>
        </div>
        <div>
            <label for="user_id">ID do Usuário</label>
            <input type="text" name="user_id" id="user_id" required>
        </div>
        <button type="submit">Criar Alerta</button>
    </form>
@endsection
