@extends('layouts.app')

@section('content')
    <h1>Criar Rendimento</h1>

    <form action="{{ route('incomes.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nome< do Rendimento/label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="amount">Quantia</label>
            <input type="number" name="amount" id="amount" required>
        </div>
        <div>
            <label for="date">Data</label>
            <input type="date" name="date" id="date" required>
        </div>
        <button type="submit">Criar Rendimento</button>
    </form>
@endsection
