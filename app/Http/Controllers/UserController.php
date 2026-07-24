<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function __invoke(Request $request): View | UserResource | JsonResponse
    {
        $user = $request->user();

        if ($request->wantsJson()) { 
            return new UserResource($user);
        };

        return view('user.profile', ['user' => $user]);
    }
}
