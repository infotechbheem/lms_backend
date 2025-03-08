<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'memberships';
    protected $fillable = ['membership_id', 'membership_name', 'plan', 'currency', 'description', 'selling_price', 'discount_price', 'cover_image', 'status'];
}
