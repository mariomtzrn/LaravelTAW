<?php

namespace App\Http\Middleware;

use Closure;
use App\Project;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $project = $request->route('project');
        if (auth()->id() == $project->owner_id) {
          return $next($request);
        } else {
          abort(403, 'Acceso no autorizado.');
        }
    }
}









