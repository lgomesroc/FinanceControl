<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateApiRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use Throwable;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /** Lista todos os usuários **/
    public function index(Request $request)
    {

        $users = User::select('name', 'email', 'id')->get();

        $users = User::select('id', 'name', 'email', 'created_at')->get();

        // API: retorna JSON
        if ($request->is('api/users')) {
            return UserResource::collection($users);
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
    public function store(UserStoreRequest $request)
    {
        try {

            $user = $this->userService->create($request->validated());

            if ($request->is('api/users')) {

                return (new UserResource($user))
                    ->additional(['message' => 'Usuário cadastrado com sucesso!'])
                    ->response()
                    ->setStatusCode(201);
            }

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
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userService->update($user, $request->validated());
        // Web: redireciona para a lista de usuários
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    /** Atualiza os dados de um usuário específico rota via api **/
    public function updateApi(UserUpdateApiRequest $request, User $user)
    {
        try {
            $user = $this->userService->update($user, $request->validated());
            // API: retorna o usuário atualizado
            return (new UserResource($user))
                ->additional(['message' => 'Usuário atualizado com sucesso!'])
                ->response()
                ->setStatusCode(200);

        } catch (Throwable $exception) {

            return response()->json(['error' => $exception->getMessage()], 500);
        }

    }

    // Exclui um usuário específico
    public function destroy(User $user, Request $request)
    {
        try {

            $this->userService->delete($user);

            if ($request->is("api/users/{$user->id}")) {
                return response()->json(['message' => 'Usuário excluído com sucesso!'], 204);
            }

            return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
