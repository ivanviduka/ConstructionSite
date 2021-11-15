<?php

namespace App\Http\Middleware;

use App\Models\Apartment;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;

class ProjectResource
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   $isValid = false;

        if ($request->route('apartmentID')) {
            $apartment = Apartment::find($request->route('apartmentID'));
            $projects = Project::where('user_id', auth()->user()->id)->get();


            if (empty($apartment)) {
                return redirect('/');
            }
            else {
                foreach ($projects as $project){
                    if($apartment->project_id == $project->id){
                        $isValid = true;
                        break;
                    }
                }
            }
        }

        if($isValid){
            return $next($request);
        } else {
            return redirect('/');
        }


    }
}
