<?php

namespace App\Repositories;

use App\Models\Problem;

class ProblemRepository
{
    public function getApartmentProblems(int $apartmentID)
    {
        return Problem::where('apartment_id', $apartmentID)
            ->orderBy('created_at', 'asc')
            ->orderBy('is_repaired', 'asc')
            ->get();
    }

    public function getProblem(int $problemID)
    {
        return Problem::find($problemID);
    }
}
