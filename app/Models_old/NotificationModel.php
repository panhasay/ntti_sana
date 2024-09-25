<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class NotificationModel extends Model
{
    protected $table = 'notifiaction' ;
    use HasFactory;

    public function countRecord(){
        $record = NotificationModel::where('is_read','no')->count() ;
        return $record  ;
    }
}
