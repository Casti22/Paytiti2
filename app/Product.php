<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public $fillable = ['title','image_url','description','price'];

    protected $guarded = ['id'];


    public function url(){
      return $this->id ? 'productos.update' : 'productos.store';
    }

    public function method(){
        return $this->id ? 'PUT' : 'POST';
    }
}
