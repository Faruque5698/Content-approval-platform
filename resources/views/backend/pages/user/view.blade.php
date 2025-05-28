@extends('backend.layouts.app')
@section('title','View User')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">View User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User List</a></li>
                <li class="breadcrumb-item active">User Details</li>
            </ol>

            <div class="d-flex justify-content-center"> <!-- Center the card horizontally -->
                <div class="card mb-4" style="width: 100%; max-width: 600px;"> <!-- Limit max width -->
                    <div class="card-header text-start"> <!-- left align header text -->
                        <i class="fas fa-user me-1"></i>
                        User Information
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-4 fw-bold">Name:</label>
                            <div class="col-sm-8">
                                {{ $user->name }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 fw-bold">Email:</label>
                            <div class="col-sm-8">
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 fw-bold">Role:</label>
                            <div class="col-sm-8">
                                {{ ucfirst($user->role) }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 fw-bold">Created At:</label>
                            <div class="col-sm-8">
                                {{ $user->created_at->format('d M Y, h:i A') }}
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 fw-bold">Updated At:</label>
                            <div class="col-sm-8">
                                {{ $user->updated_at->format('d M Y, h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
