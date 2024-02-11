<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Users\CreateUserAction;
use App\Actions\Users\DeleteUserAction;
use App\Actions\Users\FindUserByIdAction;
use App\Actions\Users\GetUsersAction;
use App\Actions\Users\UpdateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function __construct(
        protected GetUsersAction $getUsersAction,
        protected FindUserByIdAction $findUserByIdAction,
        protected UpdateUserAction $updateUserAction,
        protected CreateUserAction $createUserAction,
        protected DeleteUserAction $deleteUserAction
    ) {}

    public function index(Request $request): Response
    {
        return Inertia::render('Admin/Users/Index/Page', [
            'users' => Inertia::lazy(fn() => UserResource::collection($this->getUsersAction->run($request->all())))
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Users/CreateOrEdit/Page');
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        $this->createUserAction->run($request->validated());
        return redirect()->route('admin.users.index');
    }

    public function edit(int $id): Response
    {
        $user = $this->findUserByIdAction->run($id);

        return Inertia::render('Admin/Users/CreateOrEdit/Page', [
            'user' => new UserResource($user)
        ]);
    }

    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        $this->updateUserAction->run($request->validated(), $id);
        return redirect()->route('admin.users.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->deleteUserAction->run($id);
        return redirect()->route('admin.users.index');
    }
}
