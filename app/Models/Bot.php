<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;
    protected $table = 'bot';
    protected $fillable = ['id','chat_id','bot_id','token'];
}
