<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    public $timestamps = true;

    /**
     * Método para selecionar campos específicos de usuários.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function select($fields = ['id', 'name', 'email'])
    {
        return self::query()->select($fields)->get();
    }

    public function createTokenForWeb()
    {
        return $this->createToken('web-token')->plainTextToken;
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}
