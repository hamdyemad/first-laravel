<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $guarded =  [];

  public function category()
  {
    return $this->belongsTo(Category::class, 'cat_id');
  }


  public function hasImage()
  {
    return empty($this->image) ? false : true;
  }
}
