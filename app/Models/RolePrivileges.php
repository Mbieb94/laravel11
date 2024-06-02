<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePrivileges extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'role_id',
        'namespace'
    ];

    public function getRole()
    {
        return $this->hasMany(Roles::class, 'id');
    }

    public function getPrivilege()
    {
        return $this->hasMany(Privileges::class, 'id');
    }
}
