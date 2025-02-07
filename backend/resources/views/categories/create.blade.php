@extends('layouts.app')

@section('content')
    <h1>Criar Categoria</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 10px">
            <label for="name">Nome da Categoria</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div style="display: flex; align-items: center;">
            <label for="description" style="margin-right: 10px;">Descrição</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div style="margin-bottom: 10px;">
            <label for="type">Tipo</label>
            <select name="type" id="type" required>
                <option value="" disabled selected>Selecione . . . </option>
                @foreach($categories as $category)
                    <option value="{{ $category->type }}">{{ ($category->type) }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Criar Categoria</button>
    </form>
@endsection
