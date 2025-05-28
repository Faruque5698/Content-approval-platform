<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Services\Category\CategoryServiceInterface;
use App\Services\Post\PostServiceInterface;
use App\Services\Tag\TagServiceInterface;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    protected $postService;
    protected $categoryService;
    protected $tagService;

    public function __construct(PostServiceInterface $postService, CategoryServiceInterface $categoryService, TagServiceInterface $tagService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $this->postService->getAllPosts($request->all());

        return view('backend.pages.post.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getCategoryDropdownData();
        $tags = $this->tagService->getTagDropdownData();
        return view('backend.pages.post.create', compact('categories', 'tags'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            DB::beginTransaction();
            $post = $this->postService->storePost($request);
            DB::commit();
            Toastr::success('Post created successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('posts.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Post creation failed',['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
