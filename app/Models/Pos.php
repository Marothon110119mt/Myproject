<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;
    protected $table = 'sales';

    protected $fillable = [
        'id','date','customer_id','payablepricekhmer','payableprice','warehouse_id','paying_by','total_item','discount','paid','paid_khmer','grand_total','total','type','balance','balancekhmer','created_at','updated_at',
    ];
    public function customer_name()
    {
        return $this->belongsTo(People::class, 'customer_id');
    }
    public function warehouse_name()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
    public function payment_name()
    {
        return $this->belongsTo(Payment_method::class, 'paying_by');
    }
}
