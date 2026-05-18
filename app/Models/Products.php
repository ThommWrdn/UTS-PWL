<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;


class Products extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'stock',
        'gambar',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
