<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= QueryBuilder::for(Category::class)
            ->allowedIncludes(['performances'])
            ->get();
        return $this->successResponseWithAdditional(
            CategoryResource::collection($categories),
            'All Categories'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $category = Category::create($request->validated());

        return $this->successResponse(
            CategoryResource::make($category->load('performances')),
            'Successfully Created Category'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->successResponse(
            CategoryResource::make($category->load('performances')),
            'Successfully find Category'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        return $this->successResponse(
            CategoryResource::make($category->load('performances')),
            'Successfully Updated Category'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->successResponse(message: 'Successfully deleted Category');
    }
}
