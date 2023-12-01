<?php
// Prak 3b
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     * 
     * @param   \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)    $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->age >= 18) {
            return $next($request);
        }
        return redirect('belumdewasa');
    }
}
