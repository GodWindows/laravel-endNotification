<?php

namespace App\Http\Middleware;

use App\Models\Admin as ModelsAdmin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $adminEmails = ModelsAdmin::pluck('email')->toArray();
        $userEmail = Auth::user()->email;
        if (in_array($userEmail, $adminEmails)) {
            return $next($request);
        } else {
            return redirect()->route('home');
        }
    }
}
