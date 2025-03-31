<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'description',
        'publish_year',
        'isbn',
        'price',
        'image',
        'stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
