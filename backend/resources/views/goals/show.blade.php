@extends('layouts.app')

@section('content')
    <h1>Detalhes da Meta</h1>

    <p><strong>Título:</strong> {{ $goal->title }}</p>
    <p><strong>Descrição:</strong> {{ $goal->description }}</p>
    <p><strong>Valor Alvo:</strong> R$ {{ number_format($goal->target_amount, 2, ',', '.') }}</p>
    <p><strong>Prazo:</strong> {{ $goal->deadline ? $goal->deadline : 'Sem prazo' }}</p>

    <a href="{{ route('goals.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
