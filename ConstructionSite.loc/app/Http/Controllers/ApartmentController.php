<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
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

        session()->put('projectID', $projectID);

        if($currentProject->project_type == 'building'){
            return view('apartments-floors.building-apartments', [
                'apartments' => $this->apartments->getProjectApartments($projectID),
                'projectInfo' => $currentProject,
            ]);
        } else

        return view('apartments-floors.house-floors', [
            'apartments' => $this->apartments->getProjectApartments($projectID),
            'projectInfo' => $currentProject,
        ]);
    }

    public function createApartmentForm(){

        return view('apartments-floors.create-new-apartment', [

        ]);
    }

    public function createFloorForm(){


        return view('apartments-floors.create-new-floor', [

        ]);
    }

    public function createApartment(Request $request){
        $request->validate([
            'apartment_name' => 'required|max:255',
            'apartment_floor' => 'required|numeric|',
            'apartment_size' => 'required|numeric|min:0',
        ]);

        if(!session()->has('projectID')){
            return redirect('/');
        }

        Apartment::create([
            'name' => $request->apartment_name,
            'floor' => $request->apartment_floor,
            'squarespace' => $request->apartment_size,
            'project_id' => session()->get('projectID')
        ]);

        return redirect('/project-details/'.session()->get('projectID'));

    }
}
