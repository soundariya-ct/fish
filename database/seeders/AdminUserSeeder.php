<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
                [
                    'name' => 'Admin',
                    'email' => 'admin@codetez.com',
                    'password' => bcrypt('12345678'),
                    'status' => 1,
                    'pincode' => 600028
                ]
        ];
        Admin::insert($datas);
    }
}
