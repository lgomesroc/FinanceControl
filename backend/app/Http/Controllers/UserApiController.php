<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateApiRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use Throwable;

class UserApiController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /** Lista todos os usuários **/
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->get();
        return UserResource::collection($users);
    }

    /** Cria um novo usuário **/
    public function store(UserStoreRequest $request)
    {
        try {
            $user = $this->userService->create($request->validated());
            return (new UserResource($user))
                ->additional(['message' => 'Usuário cadastrado com sucesso!'])
                ->response()
                ->setStatusCode(201);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /** Exibe os detalhes de um usuário específico **/
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /** Atualiza os dados de um usuário específico **/
    public function update(UserUpdateApiRequest $request, User $user)
    {
        try {
            $user = $this->userService->update($user, $request->validated());
            return (new UserResource($user))
                ->additional(['message' => 'Usuário atualizado com sucesso!'])
                ->response()
                ->setStatusCode(200);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /** Exclui um usuário específico **/
    public function destroy(User $user)
    {
        try {
            $this->userService->delete($user);
            return response()->json(['message' => 'Usuário excluído com sucesso!'], 204);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
