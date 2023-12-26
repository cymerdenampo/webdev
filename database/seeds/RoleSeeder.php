<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        // Create Admin
        // $admin = new User();
        // $admin->name = 'Admin';
        // $admin->address = 'City of Naga, Cebu';
        // $admin->phone = '0000';

        // $admin->email_verified_at = now();
        // $admin->email = 'admin@gmail.com';
        // $admin->password = bcrypt('admin@gmail.com');
        // $admin->plan = 'premium';
        // $admin->save();

        // $role = Role::findByName('admin');
        // $admin->assignRole($role);

        // Create User
        $user = new User();
        $user->name = 'Test Account';
        $user->address = 'City of Naga, Cebu';
        $user->phone = '09123456798';

        $user->email_verified_at = now();
        $user->email = 'test@gmail.com';
        $user->password = bcrypt('test@gmail.com');
        $user->save();

        $role = Role::findByName('user');
        $user->assignRole($role);

    }
}
