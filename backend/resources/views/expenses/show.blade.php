@extends('layouts.app')

@section('content')
<h1>Detalhes da Despesa</h1>

<p><strong>Descrição:</strong> {{ $expense->description }}</p>
<p><strong>Valor:</strong> R$ {{ number_format($expense->amount, 2, ',', '.') }}</p>
<p><strong>Data:</strong> {{ $expense->date }}</p>

<a href="{{ route('expenses.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
