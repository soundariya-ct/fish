<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@codetez.com',
            'password' => bcrypt('12345678'),
            'status' => 1,
            'pincode' => 600028,
            'referral_code' => 600028,
            'phone' => 600028,
            'otp' => 600028,

        ]);
            $role = Role::create([
                    'name' => 'admin',
                    'guard_name' => 'admin',
                    ]);
                    // $role->givePermissionTo(Permission::all());

                $permissions = Permission::pluck('id','id')->all();

                $role->syncPermissions($permissions);

                $user->assignRole($role->id);

        // Admin::insert($datas);
        }
}
