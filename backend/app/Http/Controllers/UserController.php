<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /** Exibe o formulário para criar um novo usuário **/
    public function create()
    {
        return view('users.create');
    }

    /** Cria um novo usuário **/
    public function store(Request $request)
    {
       /** try {
            $user = $this->userService.create($request->validated());
            return redirect()->route('login')->with('success', 'Usuário criado com sucesso!');
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }*/
        //Log::info($request);
       //dd($request->all());

       $user = $this->userService->create($request->all());
       return redirect()->route('login');



    }
    /** Exibe os detalhes do usuário logado **/
    public function show()
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    /** Exibe o formulário para editar o usuário logado **/
    public function edit()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    /** Atualiza os dados do usuário logado **/
    public function update(UserUpdateRequest $request)
    {
        $user = Auth::user();
        $this->userService->update($user, $request->validated());
        return redirect()->route('users.show')->with('success', 'Dados atualizados com sucesso!');
    }

    /** Exclui a conta do usuário logado **/
    public function destroy()
    {
        $user = Auth::user();
        try {
            $this->userService->delete($user);
            Auth::logout();
            return redirect()->route('login')->with('success', 'Conta excluída com sucesso!');
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
