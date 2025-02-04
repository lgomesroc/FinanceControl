<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Throwable;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /** listar todas as categorias */
    public function index(Request $request)
    {
        $category = Category::select('id', 'name', 'description')->get();

        if ($request->is('api/category')) {
            return CategoryResource::collection($category);
        }

        return view('expenses.index', compact('category'));
    }

    /** cadastra uma categoria */
    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->categoryService->create($request->validated());

            if ($request->is('api/category')) {
                return (new CategoryResource($category))
                    ->additional(['message' => 'Categoria cadastrada com sucesso'])
                    ->response()
                    ->setStatusCode(201);
            }
            return redirect()->route('users.index')->with('success', 'Categoria criado com sucesso!');
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
