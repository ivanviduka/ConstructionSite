<?php

namespace App\Repositories;

use App\Models\Problem;

class ProblemRepository
{
    public function getApartmentProblems(int $apartmentID)
    {
        return Problem::where('apartment_id', $apartmentID)
            ->orderBy('is_repaired', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getProblem(int $problemID)
    {
        return Problem::find($problemID);
    }

    public function getProblemStatus(int $problemID)
    {
        return Problem::select('is_repaired')->find($problemID);
    }
}
