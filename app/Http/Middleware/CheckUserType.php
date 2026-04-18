<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    public function handle(Request $request, Closure $next, ...$types): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        // Convert all types to lowercase for case-insensitive comparison
        $userType = strtolower(Auth::user()->user_type);
        $allowedTypes = array_map('strtolower', $types);

        if (!in_array($userType, $allowedTypes)) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            
            return redirect()
                ->route('dashboard')
                ->with('error', 'You are not authorized to access this page');
        }

        return $next($request);
    }
}