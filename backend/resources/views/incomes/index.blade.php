@extends('layouts.app')

@section('content')
    <h1>Receitas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('incomes.create') }}" class="btn btn-primary">Adicionar Receita</a>

    <ul>
        @foreach($incomes as $income)
            <li>
                <strong>{{ $income->description }}</strong> - R$ {{ number_format($income->amount, 2, ',', '.') }}
                ({{ $income->date }})
                <a href="{{ route('incomes.edit', $income) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('incomes.destroy', $income) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
