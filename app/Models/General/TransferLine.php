<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferLine extends Model
{
    use HasFactory;
    protected $table = 'transfer_line';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        '*',
    ];
}
