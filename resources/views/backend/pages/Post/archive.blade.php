@extends('backend.layouts.app')
@section('title','Archived Posts')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Archived Post List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Archived Posts</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-archive me-1"></i>
                        <strong>Archived Posts</strong>
                    </div>

                    <form action="{{ route('posts.archive') }}" method="GET" class="d-flex gap-2 align-items-center">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                               placeholder="Search post title">

                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('posts.archive') }}" class="btn btn-secondary">Reset</a>
                    </form>

                    <a href="{{ route('posts.index') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to Posts
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Archived At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->archived_at)->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{route('posts.show',$post)}}" class="btn btn-sm btn-info">View</a>
                                    <form action="{{ route('posts.restoreArchive', $post->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                    </form>

                                    <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Permanently delete this post?')">
                                            Delete Permanently
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No archived posts found.</td>
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
