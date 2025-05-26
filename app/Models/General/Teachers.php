<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Teachers extends Model
{
    use HasFactory;
    protected $table = 'teachers';
    protected $primaryKey = 'code';
    protected $keyType = 'string'; // Specify the key type if necessary
  
    protected $fillable = [
        '*',
    ];

    public function scopeWhitQueryPermission($query)
    {
        $user = Auth::user();

        if ($user->department_code === 'D_IT') {
            return $query->where('department_code', 'D_IT');
        }
        return $query;
    }
    
}
