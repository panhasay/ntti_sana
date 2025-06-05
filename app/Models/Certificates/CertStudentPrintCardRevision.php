<?php

namespace App\Models\Certificates;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CertStudentPrintCardRevision extends Model
{
    use HasFactory;

    protected $table = 'cert_student_print_card_revision';

    protected $primaryKey = 'id';

    protected $fillable = [
        'print_card_id',
        'revision',
        'print_by',
        'print_by_date',
        'status',
    ];

    public $incrementing = true;

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->exists) {
                $model->print_by = Auth::id() ?? 0;
                $model->print_by_date = now();
            }
        });
    }
}
