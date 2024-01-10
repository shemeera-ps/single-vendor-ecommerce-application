<?php

namespace App\Models;

use Carbon\Traits\Options;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ynotz\MediaManager\Traits\OwnsMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Productvariant extends Model
{
    use HasFactory, OwnsMedia;
    protected $guarded=[];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function attributes(){
        return $this->belongsToMany(Attribute::class,'products_attributes','productvariant_id','attribute_id');
    }
    public function getMediaStorage(): array
    {
        return[
            'image'=>[
                'disk'=>'public',
                'folder'=>'images/variants'
            ],
            'imageSecond'=>[
                'disk'=>'public',
                'folder'=>'images/variants'
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
