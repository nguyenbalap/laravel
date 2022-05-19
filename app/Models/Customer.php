<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        "name",
        "address",
        "phone",
        "gender",
        "email",
        "password",
        "avatar",
    ];
}