<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\ProjectRepository;
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

    public function createProjectForm()
    {
        return view('dashboard.create-project');
    }

    public function createProject(Request $request)
    {
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

    public function changeProjectCompletion(int $projectID)
    {
        $currentStatus = $this->projects->getProjectStatus($projectID);

        Project::find($projectID)->update([
            'is_finished' => !$currentStatus->is_finished,
        ]);

        return redirect("/");
    }

    public function update(int $projectID)
    {
        session()->put('projectId', $projectID);
        return view('dashboard.update-project',
            ['project' => Project::find($projectID)]);

    }

    public function updateProject(Request $request)
    {
        if (!session()->has('projectId')) {
            return redirect("/");
        }

        $request->validate([
            'project_name' => 'required|max:255',
            'address' => 'required',
            'city' => 'required|regex:/^[a-žA-Ž ]+$/',
            'start_date' => 'required|date',
            'deadline_date' => 'required|date|after_or_equal:start_date',
        ]);

        $updatedProject = new Project;

        $updatedProject->find(session()->get('projectId'))->update([
            'project_name' => $request->project_name,
            'address' => $request->address,
            'city' => $request->city,
            'start_date' => $request->start_date,
            'deadline_date' => $request->deadline_date,
            'description' => $request->project_description,
        ]);

        session()->forget('projectId');
        return redirect('/');
    }

    public function deleteProject(int $projectID)
    {

        Project::find($projectID)->delete();

        return redirect("/");
    }


}
