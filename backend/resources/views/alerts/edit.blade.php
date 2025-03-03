@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Alerta</h1>

        <form method="POST" action="{{ route('alerts.update', $alert->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome do Alerta</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $alert->message }}" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $alert->type }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
        </form>
    </div>
@endsection
