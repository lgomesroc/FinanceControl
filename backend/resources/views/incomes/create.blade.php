@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Adicionar Receita</h1>

        <form method="POST" action="{{ route('incomes.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nome da Receita</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="amount">Valor</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
            </div>
            <div class="form-group">
                <label for="source">Fonte</label>
                <input type="text" class="form-control" id="source" name="source" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
        </form>
    </div>
@endsection
