<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;

class AuthResource
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('projectID')) {
            $project = Project::find($request->route('projectID'));
            if (empty($project) || $project->user_id != auth()->user()->id) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
