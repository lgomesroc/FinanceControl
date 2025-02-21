@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Receita</h1>

        <form method="POST" action="{{ route('incomes.update', $income->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome da Receita</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $income->name }}" required>
            </div>
            <div class="form-group">
                <label for="amount">Valor</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $income->amount }}" required>
            </div>
            <div class="form-group">
                <label for="source">Fonte</label>
                <input type="text" class="form-control" id="source" name="source" value="{{ $income->source }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
        </form>
    </div>
@endsection
