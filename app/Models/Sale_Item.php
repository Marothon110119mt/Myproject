<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_Item extends Model
{
    use HasFactory;
    protected $table = 'sale_item';
    protected $fillable = [
        'id', 'sale_id','product_id','product_code','product_name','product_price','product_discount','product_subtotal','product_quantity',
    ];
    public function product_name()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
