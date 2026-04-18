<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Http\Controllers\ProductsController;
use App\Models\Products;

class Category extends Model
{

    public function product(): HasMany
    {
        return $this->hasMany(Products::class);
    }
    protected $table = 'category';
    protected $fillable = ['name'];
}
