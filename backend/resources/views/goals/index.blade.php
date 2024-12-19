@extends('layouts.app')

@section('content')
    <h1>Metas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('goals.create') }}" class="btn btn-primary">Adicionar Meta</a>

    <ul>
        @foreach($goals as $goal)
            <li>
                <strong>{{ $goal->title }}</strong> - R$ {{ number_format($goal->target_amount, 2, ',', '.') }}
                ({{ $goal->deadline ? $goal->deadline : 'Sem prazo' }})
                <a href="{{ route('goals.edit', $goal) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('goals.destroy', $goal) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
