<?php

namespace App\Models\Certificates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertStudentPrintCardSession extends Model
{
    use HasFactory;

    protected $table = 'cert_student_print_card_session';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'session_code',
        'print_date',
        'print_khmer_lunar',
        'print_date_due',
        'print_expire_date',
        'create_by',
        'create_by_date',
        'print_by_date',
        'update_by',
        'update_by_date',
        'disable_by',
        'disable_by_date',
        'status',
    ];

    protected $casts = [
        'print_date' => 'date',
        'create_by_date' => 'date',
        'print_by_date' => 'datetime',
        'update_by_date' => 'datetime',
        'disable_by_date' => 'datetime',
    ];
}
