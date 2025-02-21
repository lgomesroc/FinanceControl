@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bem-vindo ao Dashboard, {{ $user->name }}</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <p>Você está autenticado!</p>
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar Perfil</a>
        <a href="{{ route('incomes.create') }}" class="btn btn-secondary">Adicionar Renda</a>
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
            @foreach($user->incomes as $income)
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
            @foreach($user->expenses as $expense)
                <tr>
                    <td>{{ $expense->name }}</td>
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
            @foreach($user->goals as $goal)
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
                <th>Data</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->alerts as $alert)
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

        <!-- Link para deslogar com formulário -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-warning">Deslogar</button>
        </form>

        <!-- Botão para deletar usuário com aviso -->
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir sua conta permanentemente? Esta ação não pode ser desfeita.');">
            @csrf
            @method('DELETE')
            <button type="
