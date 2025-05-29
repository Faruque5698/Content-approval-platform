@extends('backend.layouts.app')
@section('title','Edit Category')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Category</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category List</a></li>
                <li class="breadcrumb-item active">Edit Category</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-tags me-1"></i>
                    Edit Category Details
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update',$category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $category->name) }}"
                                required
                            >
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection
