<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;
    protected $table = 'process';

    protected $fillable = [
        'id', 'reference_no','warehouse_id','note','created_at','updated_at',
    ];
    public function warehouse_name()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
