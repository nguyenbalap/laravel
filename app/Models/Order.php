<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected function getStatusName(): Attribute // Accessors & Mutators
    {
        return Attribute::make(
            get: function ($value, $attribute) {
                return OrderStatusEnum::getKeyByValue($attribute['status']);
            }
        );
    }
}