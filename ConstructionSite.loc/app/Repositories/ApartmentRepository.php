<?php

namespace App\Repositories;

use App\Models\Apartment;
use Illuminate\Support\Facades\DB;

class ApartmentRepository
{
    public function getProjectApartments(int $projectID)
    {
        return Apartment::where('project_id', $projectID)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getApartment(int $apartmentID)
    {
        return Apartment::find($apartmentID);
    }

    public function getFullDetails(int $apartmentID)
    {
        return DB::table('apartments')
            ->join('projects', 'apartments.project_id', '=', 'projects.id')
            ->select('apartments.id', 'apartments.name', 'apartments.floor', 'apartments.squarespace',
                'projects.address', 'projects.city')
            ->where('apartments.id', $apartmentID)
            ->first();

    }
}
