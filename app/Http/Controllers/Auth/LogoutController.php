<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Log the user out of the application.
     */
    public function __invoke(Request $request)
    {

        if ($request->wantsJson()) {
            $request->user()->currentAccessToken()->delete();
            $request->user()->tokens()->delete();
            return response()->json([
                'message' => 'success logout'
            ], 200);
        };

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Успешный выход');
    }
}
