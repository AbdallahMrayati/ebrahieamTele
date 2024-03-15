<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermissionType extends Model
{
    use HasFactory;

    protected $table = 'role_permission_type';

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    public function permissionType()
    {
        return $this->belongsTo(PermissionType::class, 'permissionType_id');
    }
}
