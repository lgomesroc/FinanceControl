@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Despesa</h1>

        <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome da Despesa</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $expense->name }}" required>
            </div>
            <div class="form-group">
                <label for="amount">Valor</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $expense->amount }}" required>
            </div>
            <div class="form-group">
                <label for="category">Categoria</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $expense->category }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
        </form>
    </div>
@endsection
