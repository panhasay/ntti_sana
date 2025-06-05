<?php

namespace App\Models\Certificates;

use App\Models\General\Skills;
use Illuminate\Support\Facades\Auth;
use App\Models\General\Qualifications;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CertStudentOfficialTranscriptCode extends Model
{
    use HasFactory;

    protected $table = 'cert_student_official_transcript_code';

    protected $primaryKey = 'code';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'qualification_code',
        'skills_code',
        'active',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->exists) {
                $model->created_by = Auth::id() ?? 0;
                $model->created_at = now();
            }
        });
    }

    public function qualification()
    {
        return $this->belongsTo(Qualifications::class, 'qualification_code', 'code');
    }

    public function skill()
    {
        return $this->belongsTo(Skills::class, 'skills_code', 'code');
    }
}
