<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'message', 'user_id', 'date',
    ];

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
