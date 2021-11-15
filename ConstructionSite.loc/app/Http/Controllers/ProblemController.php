<?php

namespace App\Http\Controllers;

use App\Repositories\ApartmentRepository;
use App\Repositories\ProblemRepository;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    //

    protected $problems;

    public function __construct(ProblemRepository $problems)
    {

        $this->problems = $problems;
    }

    public function index(int $apartmentID){
        $apartmentsRepo = new ApartmentRepository();

        return view('problems.problems-list', [
            'apartmentDetails' => $apartmentsRepo->getFullDetails($apartmentID),
            'problems' => $this->problems->getApartmentProblems($apartmentID),
        ]);

    }
}
