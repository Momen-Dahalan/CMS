<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{

    protected $fillable = ['user_id'];

    public function user(){
        $this->belongsTo(User::class);
    }
}
