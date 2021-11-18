<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'floor', 'squarespace', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function problems()
    {
        return $this->hasMany(Problem::class);
    }
}
