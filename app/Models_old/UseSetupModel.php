<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UseSetupModel extends Model
{
    protected $table = 'user_setup';
    public $incrementing = false;
    protected $primaryKey = 'email';
    use HasFactory;
}
