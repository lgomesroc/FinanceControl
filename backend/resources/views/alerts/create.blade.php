@extends('layouts.app')

@section('content')
    <h1>Criar Alerta</h1>

    <form action="{{ route('alerts.store') }}" method="POST">
        @csrf
        <div>
            <label for="message">Mensagem</label>
            <input type="text" name="message" id="message" required>
        </div>
        <div>
            <label for="type">Tipo</label>
            <input type="text" name="type" id="type" required>
        </div>
        <button type="submit" class="btn btn-primary">Criar Alerta</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar para o Dashboard</a>
    </form>
@endsection
