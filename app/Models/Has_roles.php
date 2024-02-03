<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Has_roles extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'model_has_roles';
    protected $fillable = ['role_id','model_type','model_id'];
    public function role_name()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }
}
