<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases_Item extends Model
{
    use HasFactory;
    protected $table = 'purchases_item';

    protected $fillable = [
        'id', 'purchases_id','product_id','product_code','product_name','product_cost','product_tax','product_discount','product_subtotal','product_quantity',
    ];
    public function product_name()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
