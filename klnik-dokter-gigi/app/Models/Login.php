<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    // use HasFactory;
    public $timestamps = false;
    protected $table = 'login';
    protected $primaryKey = 'idlogin';

    public function user(){
        return $this->belongsTo('App\Models\User','user_iduser','iduser');
    }
}
