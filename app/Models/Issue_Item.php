<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue_Item extends Model
{
    use HasFactory;
    protected $table = 'issue_item';

    protected $fillable = [
        'id', 'issue_id','product_id','product_code','product_name','product_type','product_quantity',
    ];
}
