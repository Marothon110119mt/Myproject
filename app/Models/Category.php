<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['id','name','slug','code','photo','detail','subcategory'];
    public function subcategory_name()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory');
    }
}
