<?php

namespace App\Http\Controllers\Auth;

use App\Actions\UpdateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function __construct(protected UpdateUserAction $updateUserAction)
    {}

    public function index(): Response
    {
        return Inertia::render('Auth/UserProfile/Page');
    }

    public function update(UpdateUserProfileRequest $request, int $id): RedirectResponse
    {
        $this->updateUserAction->run($request->validated(), $id);
        return redirect()->back();
    }
}
