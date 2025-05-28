@extends('backend.layouts.app')
@section('title','Tags')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tag List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Tag List</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tags me-1"></i>
                        <strong>All Tags</strong>
                    </div>

                    <form action="{{ route('admin.tags.index') }}" method="GET"
                          class="d-flex gap-2 align-items-center">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                               placeholder="Search tag name">

                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Reset</a>
                    </form>

                    <a href="{{ route('admin.tags.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add Tag
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->created_at->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this tag?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No tags found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $tags->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
