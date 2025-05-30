@extends('frontend.layouts.app')
@section('title','Latest Content')
@section('content')
    <div class="page-container">
        <h2 class="page-title">Latest Content</h2>

        <!-- Search Form -->
        <div class="search-container">
            <form method="GET" action="{{route('home')}}">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control form-control-lg search-input"
                        placeholder="Search posts by title..."
                        value=""
                    >
                    <button type="submit" class="btn btn-primary search-btn">Search</button>
                </div>
            </form>
        </div>

        <!-- Card grid with fixed wrapper -->
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 d-flex mb-4">
                    <div class="card w-100">
                        @if($post->thumbnail_path)
                            <img src="{{ $post->thumbnail_path }}" class="fixed-size-img" alt="...">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                            <a href="{{ route('home.show', ['post' => $post->slug]) }}" class="btn-read-more mt-auto">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection
