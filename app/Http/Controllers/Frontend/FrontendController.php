<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Post\PostServiceInterface;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    protected $service;
    public function __construct(PostServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $posts = $this->service->getAllApprovedPosts($request->all());
        return view('frontend.pages.post.list', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = $this->service->getPostBySlug($slug);
        return view('frontend.pages.post.view', compact('post'));
    }
}
