<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionType extends Model
{
    use HasFactory;
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_permission_type');
    }
}
