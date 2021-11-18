<?php

namespace App\Http\Middleware;

use App\Models\Apartment;
use App\Models\Problem;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApartmentResource
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

        if ($request->route('problemID')) {
            $problem = Problem::find($request->route('problemID'));
        } else {
            return redirect('/');
        }

        if (empty($problem)) {
            return redirect('/');
        }

        $details = DB::table('problems')
            ->join('apartments', 'problems.apartment_id', '=', 'apartments.id')
            ->join('projects', 'apartments.project_id', '=', 'projects.id')
            ->select('problems.apartment_id', 'projects.user_id')
            ->where('problems.id', $request->route('problemID'))
            ->first();

        if ($details->user_id != auth()->user()->id) {
            return redirect('/');
        }

        return $next($request);


    }
}
