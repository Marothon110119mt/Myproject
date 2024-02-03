<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = ['id', 'name', 'price', 'cost', 'quantity','row', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type'];
    public function brand_name()
    {
        return $this->belongsTo(Brand::class, 'brand');
    }
    public function category_name()
    {
        return $this->belongsTo(Category::class, 'category');
    }
    public function unit_name()
    {
        return $this->belongsTo(Unit::class, 'unit');
    }
}
