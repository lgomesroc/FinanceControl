<!-- resources/views/alerts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Alertas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul>
        @foreach($alerts as $alert)
            <li>{{ $alert->message }} - {{ $alert->created_at }}</li>
        @endforeach
    </ul>

    <form action="{{ route('alerts.store') }}" method="POST">
        @csrf
        <input type="text" name="message" placeholder="Mensagem do alerta" required>
        <input type="text" name="user_id" placeholder="ID do usuário" required>
        <button type="submit">Criar Alerta</button>
    </form>
@endsection
