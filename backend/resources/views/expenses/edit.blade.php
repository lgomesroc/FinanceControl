@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Despesa</h1>

        <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="description">Descrição</label>
                <input type="text" class="form-control" id="description" name="description" required value="{{ $expense->description }}">
            </div>
            <div class="form-group">
                <label for="amount">Valor</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required value="{{ $expense->amount }}">
            </div>
            <div class="form-group">
                <label for="amount">Categoria</label>
                <input type="text" class="form-control" id="category" name="category" required value="{{ $expense->category }}">
            </div>
            <div class="form-group">
                <label for="date">Data</label>
                <input type="date" class="form-control" id="date" name="date" required value="{{ $expense->date }}">
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
        </form>
    </div>
@endsection
