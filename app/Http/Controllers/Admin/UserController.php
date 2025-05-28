<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Services\User\UserService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = $this->userService->getAllUsers($request->all());
        return view('backend.pages.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $user = $this->userService->storeUser($request);
            Toastr::success('User created successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            Log::error('User creation failed', ['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userService->getUserById($id);
        return view('backend.pages.user.view', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userService->getUserById($id);
        return view('backend.pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $this->userService->updateUser($request, $id);
            Toastr::success('User updated successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            Log::error('User update failed', ['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->userService->delete($id);
            Toastr::success('User deleted successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            Log::error('User deletion failed', ['error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            Toastr::error('Something went wrong!', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
