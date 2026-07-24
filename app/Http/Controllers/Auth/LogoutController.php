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
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        $request->user()->currentAccessToken()->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'success logout'
            ]);
        };

        return redirect('/')->with('success', 'Успешный выход');
    }
}
