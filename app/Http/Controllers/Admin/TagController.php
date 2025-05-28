<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagRequest;
use App\Services\Tag\TagService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    protected $service;
    public function __construct(TagService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tags = $this->service->getAllTags($request->all());
        return view('backend.pages.tag.list', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        try {
            $this->service->storeTag($request);
            Toastr::success('Tag created successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.tags.index');
        } catch (\Exception $e) {
            Log::error('Tag creation failed', ['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = $this->service->getTagById($id);
        return view('backend.pages.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, string $id)
    {
        try {
            $this->service->updateTag($request, $id);
            Toastr::success('Tag updated successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.tags.index');
        } catch (\Exception $e) {
            Log::error('Tag update failed', ['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
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
            Toastr::success('Tag deleted successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.tags.index');

        }catch (\Exception $e) {
            Log::error('Tag deletion failed', ['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
