@extends('backend.layouts.app')
@section('title','Categories')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Category List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Category List</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tags me-1"></i>
                        <strong>All Categories</strong>
                    </div>

                    <form action="{{ route('categories.index') }}" method="GET"
                          class="d-flex gap-2 align-items-center">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                               placeholder="Search category name">

                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Reset</a>
                    </form>

                    <a href="{{ route('categories.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add Category
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
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No categories found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $categories->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
