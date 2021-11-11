<?php

namespace App\Http\Controllers;

use App\Repositories\ApartmentRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    //
    protected $apartments;

    public function __construct(ApartmentRepository $apartments)
    {

        $this->apartments = $apartments;
    }

    //
    public function index(int $projectID)
    {

        $projects = new ProjectRepository();
        $currentProject = $projects->getProject($projectID);

        if($currentProject->user_id != auth()->user()->id){
            return redirect('/');
        }

        if($currentProject->project_type == 'building'){
            return view('apartments-floors.building-apartments', [
                'apartments' => $this->apartments->getProjectApartments($projectID),
            ]);
        } else

        return view('apartments-floors.house-floors', [
            'apartments' => $this->apartments->getProjectApartments($projectID),
        ]);
    }
}
