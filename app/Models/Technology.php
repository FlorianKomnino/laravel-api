<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Project;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = array('name', 'color');

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
