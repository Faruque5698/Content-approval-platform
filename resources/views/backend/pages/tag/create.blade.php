@extends('backend.layouts.app')
@section('title','Create Tag')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create Tag</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('tags.index') }}">Tag List</a></li>
                <li class="breadcrumb-item active">Create Tag</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-plus me-1"></i>
                    Add New Tag
                </div>
                <div class="card-body">
                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Tag Name <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                required
                            >
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Create Tag</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
