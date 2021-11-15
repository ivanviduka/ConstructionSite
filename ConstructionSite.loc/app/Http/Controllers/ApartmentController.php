<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Project;
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

        session()->put('projectID', $projectID);

        return view('apartments-floors.apartments-and-floors', [
            'apartments' => $this->apartments->getProjectApartments($projectID),
            'projectInfo' => Project::find($projectID),
        ]);

    }

    public function createApartmentForm()
    {

        return view('apartments-floors.create-new-apartment', [

        ]);
    }

    public function createFloorForm()
    {


        return view('apartments-floors.create-new-floor', [

        ]);
    }

    public function createApartment(Request $request)
    {
        $request->validate([
            'apartment_name' => 'required|max:255',
            'apartment_floor' => 'required|numeric|',
            'apartment_size' => 'required|numeric|min:0',
        ]);

        if (!session()->has('projectID')) {
            return redirect('/');
        }

        Apartment::create([
            'name' => $request->apartment_name,
            'floor' => $request->apartment_floor,
            'squarespace' => $request->apartment_size,
            'project_id' => session()->get('projectID')
        ]);

        $projectID = session()->get('projectID');
        session()->forget('projectID');

        return redirect('/project-details/' . $projectID);

    }

    public function update(int $apartmentID) {
        $apartment = $this->apartments->getApartment($apartmentID);
        session()->put('apartmentID', $apartmentID);
        return view('apartments-floors.update-info',
            ['apartment' => $apartment]);

    }

    public function updateApartment(Request $request) {

        if(!session()->has('apartmentID')){
            return redirect("/");
        }

        $request->validate([
            'apartment_name' => 'required|max:255',
            'apartment_floor' => 'required|numeric|',
            'apartment_size' => 'required|numeric|min:0',
        ]);



        Apartment::where('id', session()->get('apartmentID'))->update([
            'name' => $request->apartment_name,
            'floor' => $request->apartment_floor,
            'squarespace' => $request->apartment_size,
        ]);

        session()->forget('apartmentID');
        return redirect('/project-details/' . session()->get('projectID'));
    }

    public function deleteApartment(int $apartmentID)
    {

        Apartment::where('id', $apartmentID)->delete();

        return redirect('/project-details/' . session()->get('projectID'));
    }
}
