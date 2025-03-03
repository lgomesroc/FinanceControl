<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Exibe todos os usuários
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $users = User::with('incomes')->with('expenses')
            ->with('goals')->with('alerts')->get();
        return view('dashboard', ['users' => $users]);
    }

    /**
     * Exibe o formulário para criar um novo usuário
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Cria um novo usuário
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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

    /**
     * Exibe os detalhes do usuário logado
     *
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    /**
     * Exibe o formulário para editar o usuário logado
     *
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    /**
     * Atualiza os dados do usuário logado
     *
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $this->userService->update($user, $request->validated());
        return redirect()->route('users.show')->with('success', 'Dados atualizados com sucesso!');
    }

    /**
     * Exclui a conta do usuário logado
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(): RedirectResponse
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

    /**
     * Mostra o painel de controle do usuário
     *
     * @return \Illuminate\View\View
     */
    public function dashboard(): View
    {
        $user = Auth::user();
        // Você pode adicionar lógica aqui para buscar dados necessários para o dashboard

        return view('dashboard', compact('user'));
    }
}
