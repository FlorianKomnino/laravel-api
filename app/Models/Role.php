<?php

namespace App\Models;

use App\Models\Admin\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'level',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
