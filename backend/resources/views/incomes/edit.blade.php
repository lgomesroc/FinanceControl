@extends('layouts.app')

@section('content')
    <h1>Editar Receita</h1>

    <form action="{{ route('incomes.update', $income) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="description">Descrição</label>
            <input type="text" name="description" id="description" value="{{ old('description', $income->description) }}" required>
        </div>
        <div>
            <label for="amount">Valor</label>
            <input type="number" name="amount" id="amount" value="{{ old('amount', $income->amount) }}" step="0.01" required>
        </div>
        <div>
            <label for="date">Data</label>
            <input type="date" name="date" id="date" value="{{ old('date', $income->date) }}" required>
        </div>
        <button type="submit">Atualizar</button>
    </form>
@endsection
