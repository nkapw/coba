<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    protected $table = "inspection";
    protected $fillable = ['inspection_id','animal', 'cage_treatment','date','environmental_care','feeding','medical_treatment','inspector','location','suggestion','result'];

}
