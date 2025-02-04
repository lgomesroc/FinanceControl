<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function create(array $data)
    {
        return Category::create([
            'name' => $data['name'],
            'description' => $data['description']
        ]);
    }
}
