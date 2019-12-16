<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
      'user_id', 'product_catagory','title','description','num_days','cover_image', 'other_image',
  ];

}
