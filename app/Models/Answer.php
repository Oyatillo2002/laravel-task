<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //

    protected $fillable = ['application_id', 'body'];

    public function apllication(){return $this->belongsTo(Application::class);}
}
