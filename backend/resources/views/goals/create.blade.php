@extends('layouts.app')

@section('content')
    <h1>Criar Meta</h1>

    <form action="{{ route('goals.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Nome da Meta</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="description">Descrição</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div>
            <label for="target_amount">Quantia Alvo</label>
            <input type="number" step="0.01" name="target_amount" id="target_amount" required>
        </div>
        <div>
            <label for="due_date">Data Limite</label>
            <input type="date" name="due_date" id="due_date"  min="{{$dateNow }}" required>
        </div>
        <button type="submit">Criar Meta</button>
    </form>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
@endsection
