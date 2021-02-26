<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ["title", "details","status","start_date","end_date","project_manager_id"];
    public function ProjectManager()
    {
       return $this->belongsTo(User::class);
    }
}
