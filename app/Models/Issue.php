<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $table = 'issue';

    protected $fillable = [
        'id', 'reference_no','supplier_id','warehouse_id','payment_method','note','total','grand_total','total_discount','shipping','paid','created_at','updated_at',
    ];
    public function supplier_name()
    {
        return $this->belongsTo(People::class, 'supplier_id');
    }
    public function warehouse_name()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
    public function payment_name()
    {
        return $this->belongsTo(Payment_method::class, 'payment_method');
    }
}
