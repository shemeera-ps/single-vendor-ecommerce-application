<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = ['attribute', 'value'];

    // Specify the 'value' attribute as JSON
    protected $casts = [
        'value' => 'json',
    ];
    public function productTypes(){
        return $this->belongsTo(ProductType::class);
    }
  
}
