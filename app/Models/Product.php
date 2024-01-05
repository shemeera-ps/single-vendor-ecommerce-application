<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ynotz\MediaManager\Traits\OwnsMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory , OwnsMedia;
    protected $guarded=[];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function productVariants(){
        return $this->hasMany(ProductVariant::class);
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
    public function sizes(){
        return $this->belongsToMany(Size::class);
    }

    public function getMediaStorage(): array
    {
        return[
            'image'=>[
                'disk'=>'public',
                'folder'=>'images'
            ],
            'imageSecond'=>[
                'disk'=>'public',
                'folder'=>'images'
            ]
        ];
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                

                return $this->getSingleMediaForEAForm('image');
            }
        );
    }
    public function imageSecond(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->getSingleMediaForEAForm('imageSecond');
            }
        );
    }
}
