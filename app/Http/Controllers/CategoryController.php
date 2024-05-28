<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\SystemServices;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    private $systemServices;
    function __construct(SystemServices $systemServices)
    {
        $this->systemServices = $systemServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->orderBy('created_at', 'DESC')->get();
        return view('backend.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(CreateCategoryRequest $request)
    {
        $data = $this->data($request);
        $data['slug'] = str()->slug($request->title_en);
        return $this->systemServices->createSystem(Category::query(), $data, 'category', null, $request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @throws ValidationException
     */
    public function update(UpdateCategoryRequest $request, $slug)
    {
        $data = $this->data($request);
        return $this->systemServices->editSystem(Category::query(), $slug, $data, 'category', null, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        return $this->systemServices->deleteSystem(Category::query(), $slug, 'Category');
    }

    public function data($request): array
    {
        $data = $request->except('_token');
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['admin_id'] = auth()->user()->id;
        return $data;
    }
}
