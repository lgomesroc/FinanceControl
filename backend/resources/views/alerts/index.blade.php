@extends('layouts.app')

@section('content')
    <div class="container">
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
            <input type="text" name="type" placeholder="Tipo do alerta" required>
            <button type="submit" class="btn btn-primary">Criar Alerta</button>
        </form>

        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Voltar para o Dashboard</a>
    </div>
@endsection
