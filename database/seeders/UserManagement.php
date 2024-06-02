<?php

namespace Database\Seeders;

use App\Models\Privileges;
use App\Models\RolePrivileges;
use App\Models\Roles;
use Illuminate\Database\Seeder;

class UserManagement extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            'name' => 'Developers'
        ];

        Roles::create($role);

        $privilege = [
            'module' => 'DEVELOPER',
            'sub_module' => 'ALL ACCESS',
            'module_name' => 'All Access',
            'namespace' => '*',
            'ordering' => 1
        ];

        Privileges::create($privilege);

        $rolePrivilege = [
            'role_id' => '1',
            'namespace' => '*'
        ];

        RolePrivileges::create($rolePrivilege);
    }
}
