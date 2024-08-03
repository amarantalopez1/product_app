<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'height',
        'length',
        'width',
    ];
}