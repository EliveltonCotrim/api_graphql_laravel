<?php

namespace App\Models;

use App\Enum\ProjectSatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    Use HasFactory, SoftDeletes;

    protected $primaryKey = "id";
    protected $fillable = ['name', 'description', 'status'];

}
