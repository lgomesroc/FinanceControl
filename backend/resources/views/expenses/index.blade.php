@extends('layouts.app')

@section('content')
    <h1>Despesas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Adicionar Despesa</a>

    <ul>
        @foreach($expenses as $expense)
            <li>
                <strong>{{ $expense->description }}</strong> - R$ {{ number_format($expense->amount, 2, ',', '.') }}
                ({{ $expense->date }})
                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
