<?php

namespace App\Models\Certificates;

use App\Models\User;
use App\Models\General\Classes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CertStudentPrintCardExpireClass extends Model
{
    use HasFactory;

    protected $table = 'cert_student_print_card_expire_class';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'session_code',
        'class_code',
        'year',
        'expire_date',
        'print_expire_date',
        'create_by',
        'create_by_date',
        'update_by',
        'update_by_date',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->create_by = Auth::id() ?? 0;
            $model->create_by_date = now();
        });

        static::updating(function ($model) {
            $model->update_by = Auth::id() ?? 0;
            $model->update_by_date = now();
        });
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_code', 'code');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'update_by');
    }
}
