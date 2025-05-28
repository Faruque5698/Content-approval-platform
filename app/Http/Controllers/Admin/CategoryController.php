<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Services\Category\CategoryService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $service;
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = $this->service->getAllCategories($request->all());
        return view('backend.pages.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $this->service->storeCategory($request);
            Toastr::success('Category created successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            Log::error('Category creation failed', ['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->service->getCategoryById($id);
        return view('backend.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try {
            $this->service->updateCategory($request, $id);
            Toastr::success('Category updated successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            Log::error('Category update failed', ['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->service->delete($id);
            Toastr::success('Category deleted successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.categories.index');

        }catch (\Exception $e) {
            Log::error('Category deletion failed', ['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
