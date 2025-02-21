@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Meta</h1>

        <form method="POST" action="{{ route('goals.update', $goal->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $goal->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $goal->description }}" required>
            </div>
            <div class="form-group">
                <label for="target_value">Valor Alvo</label>
                <input type="number" step="0.01" class="form-control" id="target_value" name="target_value" value="{{ $goal->target_value }}" required>
            </div>
            <div class="form-group">
                <label for="due_date">Prazo</label>
                <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $goal->due_date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
        </form>
    </div>
@endsection
