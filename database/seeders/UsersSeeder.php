<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
      /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userLists = [
            [
                'photo'        => null,
                'fullname'     => 'Super Admin',
                'username'     => 'Super Admin',
                'email'        => 'admin@dev.com',
                'gender'       => 'Male',
                'role'         => 'developer',
                'address'      => 'Bekasi, Jawa Barat',
                'phone_number' => '08123456789',
                'password'     => bcrypt('admin@dev')
            ],
        ];
    
        $roleList = [
            'developer'  => '1'
        ];
        
        for($i=0; $i < count($userLists); $i++) {
            $userRole = $roleList[str_replace(' ', '_', strtolower($userLists[$i]['role']))];
            unset($userLists[$i]['role']);
    
            $user = User::insertGetId($userLists[$i]);
    
            $roleUser = [
                'user_id' => $user,
                'role_id' => $userRole
            ];
    
            UserRoles::create($roleUser);
        }
    }
}
