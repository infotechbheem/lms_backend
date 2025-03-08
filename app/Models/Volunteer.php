<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $table = "volunteers";
    protected $fillable = [
        'volunteer_id',
    ];
}
