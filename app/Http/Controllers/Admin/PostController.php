<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\Post\PostStatusChangeRequest;
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
        $post = $this->postService->getPostById($id);
        if (!$post) {
            Toastr::error('Post not found', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->route('posts.index');
        }
        return view('backend.pages.post.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = $this->postService->getPostById($id);
        if (!$post) {
            Toastr::error('Post not found', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->route('posts.index');
        }
        $categories = $this->categoryService->getCategoryDropdownData();
        $tags = $this->tagService->getTagDropdownData();
        return view('backend.pages.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $this->postService->updatePost($request, $id);
            DB::commit();
            Toastr::success('Post updated successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('posts.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Post update failed',['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
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
            $this->postService->delete($id);
            Toastr::success('Post deleted successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('posts.index');

        } catch (\Exception $e) {
            Log::error('Post deletion failed',['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the trashed posts.
     */
    public function trash(Request $request)
    {
        $posts = $this->postService->trashList($request->all());
        return view('backend.pages.post.trash', compact('posts'));
    }

    /**
     * Restore a trashed post.
     */
    public function restore($id)
    {
        try {
            $this->postService->trashRestore($id);
            Toastr::success('Post restored successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('posts.trash');

        } catch (\Exception $e) {
            Log::error('Post restoration failed',['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    /**
     * Force delete a post.
     */

    public function forceDelete($id)
    {
        try {
            DB::beginTransaction();
            $this->postService->forceDelete($id);
            DB::commit();
            Toastr::success('Post permanently deleted', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('posts.trash');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Post force deletion failed',['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    public function archive(string $id)
    {
        try {
            $this->postService->archive($id);
            Toastr::success('Post archived successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('posts.index');

        } catch (\Exception $e) {
            Log::error('Post archiving failed',['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }


    /**
     * Display a listing of the archived posts.
     */

    public function archiveList(Request $request)
    {
        $posts = $this->postService->archivedList($request->all());
        return view('backend.pages.post.archive', compact('posts'));
    }

    /**
     * Restore an archived post.
     */
    public function restoreArchive($id)
    {
        try {
            $this->postService->archiveRestore($id);
            Toastr::success('Post restored successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('posts.archive');

        } catch (\Exception $e) {
            Log::error('Post restoration failed',['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    public function updateStatus(PostStatusChangeRequest $request, string $id)
    {
        try {
            $this->postService->updateStatus($id, $request->status);
            Toastr::success('Post status updated successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('posts.index');

        } catch (\Exception $e) {
            Log::error('Post status update failed', ['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
