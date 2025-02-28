@extends('layouts.app')

@section('content')
    <h1>Categorias</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('categories.create') }}" class="btn btn-primary">Criar Categoria</a>

    <ul>
        @foreach($categories as $category)
            <li>
                <strong>{{ $category->name }} - {{ $category->type }}</strong>
                <form action="{{ url("category/$category->id") }}" method="POST" style="display:inline;">
                    <form action="{{ url("$/category/{$category->id}") }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
            </li>
        @endforeach
    </ul>
@endsection

