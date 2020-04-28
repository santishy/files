<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name'];

    public function files(){
      $this->hasMany(file::class);
    }
}
