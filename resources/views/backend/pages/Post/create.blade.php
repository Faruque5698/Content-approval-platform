@extends('backend.layouts.app')
@section('title','Create Post')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>
@endpush

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create Post</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Post List</a></li>
                <li class="breadcrumb-item active">Create Post</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-plus me-1"></i>
                    Add New Post
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Post Title <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                required
                            >
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea id="editorContent" name="content" style="display:none;">
                                    {{ old('content', $post->content ?? '') }}
                            </textarea>
                            <div id="editor" class="@error('content') is-invalid @enderror"></div>

                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="categories" class="form-label">Categories <span
                                    class="text-danger">*</span></label>
                            <select
                                name="categories[]"
                                id="categories"
                                class="form-select @error('categories') is-invalid @enderror"
                                multiple
                                required
                            >
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ (collect(old('categories'))->contains($category->id)) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags (type or select)</label><span
                                class="text-danger">*</span></label>
                            <select
                                name="tags[]"
                                id="tags"
                                class="form-select @error('tags') is-invalid @enderror"
                                required
                                multiple
                            >
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Post Image</label>
                            <div class="mb-2">
                                <img
                                    id="previewImage"
                                    src="{{asset('assets/backend/noimage.png')}}"
                                    alt="Post Image"
                                    class="img-fluid rounded shadow-sm"
                                    style="max-height: 100px; object-fit: cover;"
                                >
                            </div>
                            <input
                                type="file"
                                name="image"
                                id="imageInput"
                                class="form-control @error('image') is-invalid @enderror"
                                accept="image/*"
                            >
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Create Post</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>

        ClassicEditor
            .create(document.querySelector('#editorContent'))
            .catch(error => {
                console.error(error);
            });


        $(document).ready(function () {
            $('#categories').select2({
                placeholder: "Select categories",
                allowClear: true
            });

            $('#tags').select2({
                tags: true,
                tokenSeparators: [','],
                placeholder: "Add tags"
            });
        });

        document.getElementById('imageInput').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewImage');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });

    </script>
@endpush
