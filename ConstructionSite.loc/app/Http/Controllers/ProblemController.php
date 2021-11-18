<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Repositories\ApartmentRepository;
use App\Repositories\ProblemRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProblemController extends Controller
{
    //

    protected $problems;

    public function __construct(ProblemRepository $problems)
    {
        $this->problems = $problems;
    }

    public function index(int $apartmentID)
    {
        $apartmentsRepo = new ApartmentRepository();

        session()->put('apartmentID', $apartmentID);

        return view('problems.problems-list', [
            'apartmentDetails' => $apartmentsRepo->getFullDetails($apartmentID),
            'problems' => $this->problems->getApartmentProblems($apartmentID),
        ]);

    }

    public function createProblemForm()
    {
        return view('problems.create-new-problem');
    }

    public function createProblem(Request $request)
    {
        $request->validate([
            'images' => 'required|max:2048|',
            'images.*' => 'mimes:png,jpg,jpeg,gif,bmp,svg',
            'apartment_room' => 'required|max:255|regex:/^[a-žA-Ž ]+$/',
            'project_description' => 'required|',
            'repair_deadline' => 'required|date|after_or_equal:today',
        ]);

        if (!session()->has('apartmentID')) {
            return redirect('/');
        }

        $apartmentID = session()->get('apartmentID');
        session()->forget('apartmentID');

        $imagesPaths = "";
        if ($request->hasfile('images')) {

            $imagesPaths = $this->saveImages($request, $imagesPaths);
        }

        $imagesPaths = rtrim($imagesPaths, ',');

        Problem::create([
            'filepath' => $imagesPaths,
            'apartment_area' => $request->apartment_room,
            'problem_recorded_date' => Carbon::today()->format('Y-m-d'),
            'repairing_deadline_date' => $request->repair_deadline,
            'description' => $request->project_description,
            'is_repaired' => false,
            'apartment_id' => $apartmentID,
        ]);

        return redirect('/problems/' . $apartmentID);
    }

    public function changeProblemCompletion(int $problemID)
    {
        $problemStatus = $this->problems->getProblemStatus($problemID);

        Problem::find($problemID)->update([
            'is_repaired' => !$problemStatus->is_repaired,
        ]);

        return redirect('/problems/' . session()->get('apartmentID'));
    }

    public function update(int $problemID)
    {

        session()->put('problemID', $problemID);

        return view('problems.update-problem', [
            'problem' => $this->problems->getProblem($problemID),
        ]);
    }

    public function updateProblem(Request $request)
    {
        if (!session()->has('problemID')) {
            return redirect("/");
        }

        $request->validate([
            'apartment_room' => 'required|max:255|regex:/^[a-žA-Ž ]+$/',
            'project_description' => 'required|',
            'repair_deadline' => 'required|date|after_or_equal:today',
        ]);

        Problem::where('id', session()->get('problemID'))->update([
            'apartment_area' => $request->apartment_room,
            'description' => $request->project_description,
            'repairing_deadline_date' => $request->repair_deadline,
        ]);

        session()->forget('problemID');
        return redirect('/problems/' . session()->get('apartmentID'));

    }

    public function deleteProblem(int $problemID)
    {
        $problem = $this->problems->getProblem($problemID);

        $this->deleteImagesFromStorage($problem);

        Problem::find($problemID)->delete();

        return redirect('/problems/' . session()->get('apartmentID'));
    }

    /**
     * @param Request $request
     * @param string $imagesPaths
     * @return string
     */
    public function saveImages(Request $request, string $imagesPaths): string
    {
        foreach ($request->file('images') as $image) {
            $uniqueName = Str::uuid()->toString() . "." . $image->extension();
            $image->storeAs('problem-images', $uniqueName);
            $imagesPaths .= $uniqueName . ',';
        }
        return $imagesPaths;
    }

    /**
     * @param $problem
     */
    public function deleteImagesFromStorage($problem): void
    {
        foreach (explode(',', $problem->filepath) as $image) {
            Storage::delete('problem-images/' . $image);
        }
    }

}
