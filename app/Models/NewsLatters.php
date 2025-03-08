<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLatters extends Model
{
    protected $table = "newslatters";
    protected $fillable = [
        'email'
    ];
}
