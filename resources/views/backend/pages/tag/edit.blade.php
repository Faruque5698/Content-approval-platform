@extends('backend.layouts.app')
@section('title','Edit Tag')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Tag</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('tags.index') }}">Tag List</a></li>
                <li class="breadcrumb-item active">Edit Tag</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-tags me-1"></i>
                    Edit Tag Details
                </div>
                <div class="card-body">
                    <form action="{{ route('tags.update',  $tag) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Tag Name <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $tag->name) }}"
                                required
                            >
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Tag</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
