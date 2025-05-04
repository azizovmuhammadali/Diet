<?php

namespace App\Models;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['name', 'description'];
    protected $fillable = [
        'calory',
        'image',
        'slug',
        'price',
    ];
    public function url(): Attribute
    {
        return Attribute::make(fn(): string => URL::to('storage/' . $this->image));
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class,'order_products');
    }
}