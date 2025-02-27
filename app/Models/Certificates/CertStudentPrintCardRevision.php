<?php

namespace App\Models\Certificates;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CertStudentPrintCardRevision extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'cert_student_print_card_revision';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Set the auto-incrementing key as true if it's a BIGINT type
    public $incrementing = true;

    // Specify the connection if not using the default one
    // protected $connection = 'mysql'; // Uncomment and modify if needed

    // Define the attributes that are mass assignable
    protected $fillable = [
        'print_card_id',
        'revision',
        'print_by',
        'print_by_date',
        'status'
    ];

    // Define the attributes that should be cast to specific data types
    protected $casts = [
        'print_by_date' => 'datetime',
        'auto_date' => 'datetime',
    ];

    // Disable timestamps if you don't have created_at and updated_at columns
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->print_by = Auth::id() ?? 0;
            $model->print_by_date = now();
        });
    }
}
