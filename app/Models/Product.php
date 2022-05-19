<?php

namespace App\Models;

use App\Enums\ProductEnumType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        "name",
        "price",
        "description",
        "image",
        "type",
        "producer_id",

    ];
    protected function getTypeName(): Attribute // Accessors & Mutators
    {
        return Attribute::make(
            get: function ($value, $attribute) {
                return ProductEnumType::getKeyByValue($attribute['type']);
            }
        );
    }
}