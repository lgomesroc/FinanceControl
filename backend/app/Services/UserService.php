<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /** serviço para salvar um usuário */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /** atualiza o usuário */
    public function update(User $user, array $data)
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'] ? bcrypt($data['password']) : $user->password,
        ]);

        return $user;
    }

    /** deleta um usuário */
    public function delete(User $user)
    {
        return $user->delete();
    }
}


