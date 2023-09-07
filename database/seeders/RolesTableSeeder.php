<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
        ]);
        
        DB::table('user_roles')->insert([
            'role_name' => 'ContentManager',
            'role_slug' => 'contentManager',
        ]);
        
        DB::table('user_roles')->insert([
            'role_name' => 'UserManager',
            'role_slug' => 'userManager',
        ]);
    }
}
