@extends('frontend.layouts.app')
@section('title','Content')
@section('content')
    <div class="page-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h1 class="text-center fw-bold mb-2">{{ $post->title }}</h1>

                            <p class="text-center text-muted mb-4">
                                By <strong>{{ $post->user->name ?? 'Unknown Author' }}</strong> |
                                {{ $post->created_at->format('d M Y, h:i A') }}
                            </p>

                            @if($post->image_path)
                                <div class="text-center mb-4">
                                    <img src="{{ asset($post->image_path) }}" class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover;">
                                </div>
                            @endif

                            <div class="mb-4">
                                {!! $post->content !!}
                            </div>

                            @if($post->categories && $post->categories->count())
                                <div class="mb-3">
                                    <strong>Category:</strong>
                                    @foreach($post->categories as $category)
                                        <span class="badge bg-info text-dark">{{ $category->name }}</span>
                                    @endforeach
                                </div>
                            @endif

                            @if($post->tags && $post->tags->count())
                                <div class="mb-3">
                                    <strong>Tags:</strong>
                                    @foreach($post->tags as $tag)
                                        <span class="badge bg-secondary me-1">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mb-3">
                                <span class="badge
                                    @if($post->status == 'approved') bg-success
                                    @elseif($post->status == 'rejected') bg-danger
                                    @else bg-warning text-dark
                                    @endif">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </div>

                            @if($post->thumbnail_path)
                                <div class="mb-4">
                                    <h6 class="text-secondary">Thumbnail Preview:</h6>
                                    <img src="{{ asset($post->thumbnail_path) }}" class="img-thumbnail shadow-sm" alt="Thumbnail">
                                </div>
                            @endif

                            <div class="row mb-2 text-muted">
                                <div class="col-md-4"><strong>Archived At:</strong> {{ $post->archived_at ?? 'N/A' }}</div>
                                <div class="col-md-4"><strong>Deleted At:</strong> {{ $post->deleted_at ?? 'N/A' }}</div>
                                <div class="col-md-4"><strong>Updated:</strong> {{ $post->updated_at->format('d M Y, h:i A') }}</div>
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('home') }}" class="btn btn-outline-primary">← Back to List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
