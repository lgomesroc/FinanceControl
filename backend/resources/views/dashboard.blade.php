@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h1>Bem-vindo ao Dashboard, {{ Auth::user()->name }}</h1>
        <p>Você está autenticado!</p>

        <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-primary">Editar Perfil</a>
        <a href="{{ route('incomes.create') }}" class="btn btn-secondary">Adicionar Receita</a>
        <a href="{{ route('expenses.create') }}" class="btn btn-secondary">Adicionar Despesa</a>
        <a href="{{ route('goals.create') }}" class="btn btn-secondary">Adicionar Meta</a>
        <a href="{{ route('alerts.create') }}" class="btn btn-secondary">Adicionar Alerta</a>

        <!-- Listagem de Receitas -->
        <h2>Suas Receitas</h2>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Valor</th>
                <th>Fonte</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach(Auth::user()->incomes as $income)
                <tr>
                    <td>{{ $income->name }}</td>
                    <td>{{ $income->amount }}</td>
                    <td>{{ $income->source }}</td>
                    <td>
                        <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('incomes.destroy', $income->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta receita permanentemente? Esta ação não pode ser desfeita.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Listagem de Despesas -->
        <h2>Suas Despesas</h2>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Valor</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach(Auth::user()->expenses as $expense)
                <tr>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->category }}</td>
                    <td>
                        <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta despesa permanentemente? Esta ação não pode ser desfeita.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Listagem de Metas -->
        <h2>Suas Metas</h2>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Data de Conclusão</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach(Auth::user()->goals as $goal)
                <tr>
                    <td>{{ $goal->name }}</td>
                    <td>{{ $goal->description }}</td>
                    <td>{{ $goal->due_date }}</td>
                    <td>
                        <a href="{{ route('goals.edit', $goal->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta meta permanentemente? Esta ação não pode ser desfeita.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Listagem de Alertas -->
        <h2>Seus Alertas</h2>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Data de Alerta</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach(Auth::user()->alerts as $alert)
                <tr>
                    <td>{{ $alert->name }}</td>
                    <td>{{ $alert->description }}</td>
                    <td>{{ $alert->alert_date }}</td>
                    <td>
                        <a href="{{ route('alerts.edit', $alert->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('alerts.destroy', $alert->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este alerta permanentemente? Esta ação não pode ser desfeita.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Botões de Logout e Excluir Usuário -->
        <a href="{{ route('logout') }}" class="btn btn-secondary mt-3"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="{{ route('users.destroy', Auth::user()->id) }}" class="btn btn-danger mt-3"
           onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.')) document.getElementById('delete-user-form').submit();">Excluir Conta</a>
        <form id="delete-user-form" action="{{ route('users.destroy', Auth::user()->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection
