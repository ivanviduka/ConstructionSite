<?php

namespace App\Http\Middleware;

use App\Models\Apartment;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectResource
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
        if ($request->route('apartmentID')) {
            $apartment = Apartment::find($request->route('apartmentID'));
        } else {
            return redirect('/');
        }

        if (empty($apartment)) {
            return redirect('/');
        }

        $details = DB::table('apartments')
            ->join('projects', 'apartments.project_id', '=', 'projects.id')
            ->select('projects.user_id')
            ->where('apartments.id', $request->route('apartmentID'))
            ->first();

        if ($details->user_id == auth()->user()->id) {
            return $next($request);
        } else {
            return redirect('/');
        }

    }
}
