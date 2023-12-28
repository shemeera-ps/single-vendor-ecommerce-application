<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function quantity(){
        return $this->hasOne(Quantity::class);
    }

    public function orderitem(){
        return $this->hasMany(OrderItem::class);
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }
}
