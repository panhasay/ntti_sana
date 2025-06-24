<?php

namespace App\Models\Certificates;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CertStudentStatus extends Model
{
    use HasFactory;

    protected $table = 'cert_student_statuses';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'stu_code',
        'class_code',
        'off_code',
        'reference_code',
        'print_date',
        'print_by',
        'print_by_date',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->exists && $model->isCheck === 'print') {
                $model->print_by = Auth::id() ?? 0;
                $model->print_by_date = now();
            } else {
                $model->print_by = null;
                $model->print_by_date = null;
            }
        });
    }
}
