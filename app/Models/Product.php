<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'description', 'price', 'discount_price'];

    //connect with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //connect with wish_lists
    public function wish_lists()
    {
        return $this->hasMany(WishList::class);
    }

    //connect with product images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
