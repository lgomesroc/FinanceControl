@extends('layouts.app')

@section('content')
    <h1>Criar Meta</h1>

    <form action="{{ route('goals.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nome da Meta</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="user_id">ID do Usuário</label>
            <input type="number" name="user_id" id="user_id" required>
        </div>
        <div>
            <label for="target_amount">Quantia Alvo</label>
            <input type="number" step="0.01" name="target_amount" id="target_amount" required>
        </div>
        <div>
            <label for="description">Descrição</label>
            <input type="text" name="description" id="description" required>
        </div>
        <button type="submit">Criar Meta</button>
    </form>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
@endsection
