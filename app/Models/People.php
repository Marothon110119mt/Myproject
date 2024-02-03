<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $table = 'people';
    protected $fillable = ['id','name','email','phone','address','city','state','postal_code','country','group_id','group_price','cf1','cf2'];
}
