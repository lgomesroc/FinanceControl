@extends('layouts.app')

@section('content')
    <h1>Editar Rendimento</h1>

    <form action="{{ route('incomes.update', $income->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nome do Rendimento</label>
            <input type="text" name="name" id="name" value="{{ old('name', $income->name) }}" required>
        </div>
        <div>
            <label for="amount">Quantia</label>
            <input type="number" name="amount" id="amount" value="{{ old('amount', $income->amount) }}" required>
        </div>
        <div>
            <label for="date">Data</label>
            <input type="date" name="date" id="date" value="{{ old('date', $income->date) }}" required>
        </div>
        <button type="submit">Atualizar Rendimento</button>
    </form>
@endsection
