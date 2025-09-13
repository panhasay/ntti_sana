<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class ExamDateKhmer extends Model
{
    protected $table = 'exam_date_khmer';
    
    protected $fillable = [
        'date_khmer',
        'exam_schedule_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function examSchedule()
    {
        return $this->belongsTo(ExamSchedule::class, 'exam_schedule_id');
    }
} 