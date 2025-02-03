<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Throwable;

class UserController extends Controller
{
    // Lista todos os usuários
    public function index(Request $request)
    {
        $users = User::select('id', 'name', 'email', 'created_at')->get();

        // API: retorna JSON
        if ($request->is('api/users')) {
            return response()->json([$users], 200);
        }

        // Web: retorna view
        return view('users.index', compact('users'));
    }

    // Exibe o formulário para criar um novo usuário
    public function create()
    {
        return view('users.create');
    }

    /** Cria um novo usuário **/
    public function store(Request $request)
    {
        try {
            // Definir regras de validação
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|string|min:8' . ($request->path() !== 'api/users/' ? '' : '|confirmed'),
            ];

            // Validar a solicitação
            $validated = $request->validate($rules);

            // Criar o usuário
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);
            if ($request->is('api/users')) {
                return response()->json([
                    'user' => $user,
                    'message' => 'Usuário cadastrado com sucesso!'],
                    201);
            }

            // Web: redireciona para a lista de usuários
            return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');

        } catch (Throwable $exception) {

            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /** Exibe os detalhes de um usuário específico **/
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /** Exibe o formulário para editar um usuário **/
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /** Atualiza os dados de um usuário específico via web **/
    public function update(Request $request, User $user)
    {
        $user = User::findOrFail($user->id);

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

    /** Atualiza os dados de um usuário específico rota via api **/
    public function updateApi(Request $request, User $user)
    {
        try {

            $user = User::findOrFail($request->id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'nullable|string|min:8',
            ]);

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
            ]);
            return response()->json([
                'message' => 'Usuário atualizados com sucesso!',
                'user' => $user
            ], 201);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    // Exclui um usuário específico
    public function destroy(User $user, Request $request)
    {
        if ($request->is("api/users/$request->id")) {
            $user = User::findOrFail($request->id);
            $user->delete();
            return response()->json(['message' => 'Usuário excluído com sucesso!'], 204);
        }
        $user->delete();
        // Web: redireciona para a lista de usuários
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
