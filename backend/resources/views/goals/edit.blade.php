@extends('layouts.app')

@section('content')
    <h1>Editar Meta</h1>

    <form action="{{ route('goals.update', $goal) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Título</label>
            <input type="text" name="title" id="title" value="{{ old('title', $goal->title) }}" required>
        </div>
        <div>
            <label for="description">Descrição</label>
            <textarea name="description" id="description">{{ old('description', $goal->description) }}</textarea>
        </div>
        <div>
            <label for="target_amount">Valor Alvo</label>
            <input type="number" name="target_amount" id="target_amount" value="{{ old('target_amount', $goal->target_amount) }}" step="0.01" required>
        </div>
        <div>
            <label for="deadline">Prazo</label>
            <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $goal->deadline) }}">
        </div>
        <button type="submit">Atualizar</button>
    </form>
@endsection
