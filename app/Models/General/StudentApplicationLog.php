<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentApplicationLog extends Model
{
    use HasFactory;
    protected $table = 'student_application_logs';
    public $timestamps = false;
    
    protected $fillable = [
        'student_code',
        'posting_date',
        'action',
        'description',
        'status',
        'created_by',
        'created_at',
    ];

    protected $casts = [
        'posting_date' => 'date',
        'created_at'   => 'datetime',
    ];
}
