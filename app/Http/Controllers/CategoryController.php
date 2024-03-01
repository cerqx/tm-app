<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(): ResourceCollection
    {
         return CategoryResource::collection(Category::paginate(10));
    }

    public function store(CreateCategoryRequest $request): CategoryResource
    {
        return new CategoryResource(Category::create($request->validated()));
    }

    public function show(int $id): CategoryResource
    {
        return new CategoryResource(Category::findOrFail($id));
    }

    public function update(EditCategoryRequest $request, int $id): CategoryResource
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function destroy(int $id): Response
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->noContent();
    }
}
