@extends('layouts.app')

@section('content')
    <h1>Adicionar Meta</h1>

    <form action="{{ route('goals.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Título</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="description">Descrição</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <label for="target_amount">Valor Alvo</label>
            <input type="number" name="target_amount" id="target_amount" step="0.01" required>
        </div>
        <div>
            <label for="deadline">Prazo</label>
            <input type="date" name="deadline" id="deadline">
        </div>
        <button type="submit">Salvar</button>
    </form>
@endsection
