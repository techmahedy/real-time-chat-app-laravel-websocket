<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
      'name','slug','status'
    ];

    public function posts(){

       return $this->hasMany(Post::class,'id');
       
    }
}
