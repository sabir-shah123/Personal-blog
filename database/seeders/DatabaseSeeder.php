<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'helper',
                'slug' => 'agent',
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ]);

        DB::table('users')->insert([
            [
                'role_id' => 1,
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'image' => 'default.png',
                'about' => 'Bio of admin',
                'password' => bcrypt('123456'),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'role_id' => 2,
                'name' => 'helper',
                'username' => 'helper',
                'email' => 'helper@helper.com',
                'image' => 'default.png',
                'about' => '',
                'password' => bcrypt('123456'),
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ]);

    }
}
