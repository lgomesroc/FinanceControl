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
        $categories = Category::select('id', 'name', 'type', 'description')->get();

        if ($request->is('api/categories')) {
            return CategoryResource::collection($categories);
        }

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = collect([
            (object)['type' => 'incomes'],
            (object)['type' => 'expenses']
        ]);

        return view('categories.create', compact('categories'));
    }

    /** cadastrar uma categoria */
    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->categoryService->create($request->validated());

            if ($request->is('api/categories')) {
                return (new CategoryResource($category))
                    ->additional(['message' => 'Categoria cadastrada com sucesso'])
                    ->response()
                    ->setStatusCode(201);
            }
            return redirect()->route('categories.index')->with('success', 'Categoria criado com sucesso!');
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /** Excluir uma categoria */
    public function destroy(Category $category, Request $request)
    {
        try {

            $this->categoryService->delete($category);

            if ($request->is("api/categories/{$category->id}")) {
                return response()->json(['message' => 'Categoria excluída com sucesso!'], 204);
            }
            return redirect()->route('users.index')->with('success', 'Categoria excluída com sucesso!');
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
