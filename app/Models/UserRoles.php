<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRoles extends Resources
{
    use HasFactory, SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'user_roles';

    protected $rules = [
        'user_id' => ['required'],
        'role_id' => ['required']
    ];

    protected $forms = [
        [
            'name' => 'user_id',
            'required' => true,
            'column' => 4,
            'label' => 'User',
            'type' => 'select2',
            'options' => [
                'model' => 'users',
                'key' => 'id',
                'display' => 'username'
            ],
            'display' => true
        ],
        [
            'name' => 'role_id',
            'required' => true,
            'column' => 5,
            'label' => 'Role',
            'type' => 'select2',
            'options' => [
                'model' => 'roles',
                'key' => 'id',
                'display' => 'name'
            ],
            'display' => true
        ]
    ];

    protected $fillable = [
        'id',
        'user_id',
        'role_id'
    ];

    protected $reference = [
        'user_id',
        'role_id'
    ];

    public function getReference() : array
    {
        return $this->reference;
    }

    public function getFields()
    {
        return $this->fillable;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function user_id()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function role_id()
    {
        return $this->hasOne(Roles::class, 'id', 'role_id');
    }

    public function rolePrevileges()
    {
        return $this->hasMany(RolePrivileges::class, 'role_id', 'role_id');
    }
}
