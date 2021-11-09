<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    protected $projects;

    public function __construct(ProjectRepository $projects)
    {

        $this->projects = $projects;
    }

    //
    public function index()
    {
        return view('dashboard.homepage', [
            'projects' => $this->projects->getUserProjects(auth()->user()->id),
        ]);
    }


    public function createProjectForm(){
        return view('dashboard.create-project');
    }

    public function createProject(Request $request){
        $request->validate([
            'project_name' => 'required|max:255',
            'address' => 'required',
            'city' => 'required|regex:/^[a-žA-Ž ]+$/',
            'project_type' => 'required|in:house,building',
            'start_date' => 'required|date',
            'deadline_date' => 'required|date|after_or_equal:start_date',
        ]);

        Project::create([
            'project_name' => $request->project_name,
            'address' => $request->address,
            'city' => $request->city,
            'start_date' => $request->start_date,
            'deadline_date' => $request->deadline_date,
            'project_type' => $request->project_type,
            'description' => $request->project_description,
            'is_finished' => false,
            'user_id' => auth()->user()->id,
        ]);

        return redirect("/");
    }

    public function deleteProject(int $project_id)
    {

        Project::where('id', $project_id)->delete();

        return redirect("/");
    }
}
