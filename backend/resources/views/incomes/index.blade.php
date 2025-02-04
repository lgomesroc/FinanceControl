@extends('layouts.app')

@section('content')
    <h1>Rendimentos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('incomes.create') }}" class="btn btn-primary">Criar Rendimento</a>

    <ul>
        @foreach($incomes as $income)
            <li>
                <strong>{{ $income->name }}</strong> - {{ $income)->amount }}
                <a href="{{ url("incomes/$income->id/edit") }}" class="btn btn-warning">Editar</a>
                <form action="{{ url("incomes/$income->id") }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
