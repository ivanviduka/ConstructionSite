<?php

namespace App\Repositories;

use App\Models\Apartment;

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
}
