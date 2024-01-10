<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $casts = [
        'applicable_attributes' => 'array',
    ];
    public function attributes(){
        return $this->hasMany(Attribute::class);
    }
}
