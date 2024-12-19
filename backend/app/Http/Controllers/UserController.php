<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Lista todos os usuários
    public function index()
    {
        $users = User::all();

        // API: retorna JSON
        if (request()->wantsJson()) {
            return response()->json($users);
        }

        // Web: retorna view
        return view('users.index', compact('users'));
    }

    // Exibe o formulário para criar um novo usuário
    public function create()
    {
        return view('users.create');
    }

    // Cria um novo usuário
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // API: retorna o usuário criado
        if ($request->wantsJson()) {
            return response()->json($user, 201);
        }

        // Web: redireciona para a lista de usuários
        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    // Exibe os detalhes de um usuário específico
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Exibe o formulário para editar um usuário
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Atualiza os dados de um usuário específico
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . '|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
        ]);

        // API: retorna o usuário atualizado
        if ($request->wantsJson()) {
            return response()->json($user);
        }

        // Web: redireciona para a lista de usuários
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    // Exclui um usuário específico
    public function destroy(User $user)
    {
        $user->delete();

        // API: retorna status de sucesso
        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        // Web: redireciona para a lista de usuários
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
