<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['project_name', 'address', 'city', 'start_date', 'deadline_date', 'project_type', 'description', 'is_finished', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
