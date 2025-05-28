@extends('backend.layouts.app')
@section('title','Users')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">User List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">User List</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users me-1"></i>
                        <strong>All Users</strong>
                    </div>

                    <form action="{{ route('admin.users.index') }}" method="GET"
                          class="d-flex gap-2 align-items-center">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                               placeholder="Search name/email">

                        <select name="role" class="form-select">
                            <option value="">All Roles</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>

                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Reset</a>
                    </form>

                    <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add User
                    </a>
                </div>


                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role == 'admin' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{route('admin.users.show',$user)}}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{route('admin.users.edit',$user)}}"
                                       class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{asset('assets/backend')}}/js/datatables-simple-demo.js"></script>
@endpush
