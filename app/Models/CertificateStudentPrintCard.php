<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateStudentPrintCard extends Model
{
    use HasFactory;
    protected $table = 'cert_student_print_card';
    protected $primaryKey = 'id';
    protected $fillable = [
        'stu_code',
        'class_code',
        'print_code',
        'print_by',
        'print_by_date',
        'update_by',
        'update_by_date',
        'disable_by',
        'disable_by_date',
        'status',
    ];
    //protected $fillable = [];
    public $timestamps = false;
}
