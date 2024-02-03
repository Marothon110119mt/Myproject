<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process_Item extends Model
{
    use HasFactory;
    protected $table = 'process_item';

    protected $fillable = [
        'id', 'process_id','product_id','product_code','product_name','product_type','product_quantity',
    ];
}
