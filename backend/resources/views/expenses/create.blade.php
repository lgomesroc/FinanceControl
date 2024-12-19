@extends('layouts.app')

@section('content')
    <h1>Adicionar Despesa</h1>

    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf
        <div>
            <label for="description">Descrição</label>
            <input type="text" name="description" id="description" required>
        </div>
        <div>
            <label for="amount">Valor</label>
            <input type="number" name="amount" id="amount" step="0.01" required>
        </div>
        <div>
            <label for="date">Data</label>
            <input type="date" name="date" id="date" required>
        </div>
        <button type="submit">Salvar</button>
    </form>
@endsection
