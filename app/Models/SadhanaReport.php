<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SadhanaReport extends Model
{
    protected $table ='sadhana_reports';
    protected $fillable = [
        'student_id', 'wake_up_time', 'mangla_arti', 'chanting_round_before_9_am', 'chanting_round_between_9_am_to_9_pm', 'chanting_round_after_9_pm',
        'hearing_duration_hour','hearing_duration_minute','reading_duration_hour', 'reading_duration_minute', 'sleeping_time'
    ];
}
