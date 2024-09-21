<?php

namespace App\Http\Middleware;

use App\Models\MaintainanceText;
use Closure;
use Illuminate\Http\Request;

class MaintainaceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $maintainance = MaintainanceText::first();
        if ($maintainance->status == 1) {
            return response()->json(['message' => 'maintainace_mode'], 500);
        }
        return $next($request);
    }
}
