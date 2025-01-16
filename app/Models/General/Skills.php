<?php

namespace App\Models\General;

use App\Models\SystemSetup\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;
    protected $table = 'skills';
    protected $primaryKey = 'code';
    protected $keyType = 'string'; 
  
    protected $fillable = [
        '*',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_code', 'code');
    }
    public function classes()
    {
        return $this->hasMany(Classes::class, 'skills_code', 'code');
    }
}
