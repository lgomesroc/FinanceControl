<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as AuthenticatableBase;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends AuthenticatableBase implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Definir a relação com Income
    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    // Definir a relação com Expense
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    // Definir a relação com Goal
    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }

    // Definir a relação com Alert
    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class);
    }
}
