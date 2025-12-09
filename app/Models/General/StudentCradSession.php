<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCradSession extends Model
{
    protected $table = 'student_card_session';
    
    protected $primaryKey = 'id';
    protected $keyType = 'string'; 

    public function student()
    {
        return $this->belongsTo(StudentRegistration::class, 'student_code', 'code');
    }
    public function studentImg()
    {
        return $this->belongsTo(Picture::class, 'code', 'code');
    }
}
