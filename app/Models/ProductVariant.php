<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ynotz\MediaManager\Traits\OwnsMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;


class ProductVariant extends Model
{
    use HasFactory,OwnsMedia;
    protected $guarded=[];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function sizes(){
        return $this->belongsToMany(Size::class);
    }
    public function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->getSingleMediaForEAForm('image');
            }
        );
    }
    public function getMediaStorage(): array
    {
        return[
            'image'=>[
                'disk'=>'public',
                'folder'=>'images/variants'
            ]
        ];
    }

}
