@extends('backend.layouts.app')
@section('title','Posts')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Post List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Post List</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-alt me-1"></i>
                        <strong>All Posts</strong>
                    </div>

                    <form action="{{ route('posts.index') }}" method="GET"
                          class="d-flex gap-2 align-items-center">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                               placeholder="Search post title">

                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Reset</a>
                    </form>

                    <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add Post
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->name ?? 'N/A' }}</td>
                                <td>
                                    @if($post->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($post->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($post->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($post->status) }}</span>
                                    @endif
                                </td>
                                <td>{{ $post->created_at->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this post?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No posts found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $posts->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
