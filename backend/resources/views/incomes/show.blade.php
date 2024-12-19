@extends('layouts.app')

@section('content')
    <h1>Detalhes da Receita</h1>

    <p><strong>Descrição:</strong> {{ $income->description }}</p>
    <p><strong>Valor:</strong> R$ {{ number_format($income->amount, 2, ',', '.') }}</p>
    <p><strong>Data:</strong> {{ $income->date }}</p>

    <a href="{{ route('incomes.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
