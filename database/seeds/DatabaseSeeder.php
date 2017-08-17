<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
        $faker = Faker::create();

        $users = [
            ['name' => 'adminadmin', 'email' => 'admin@admin.admin', 'password' => 'adminadmin'],
            ['name' => 'emp1emp1', 'email' => 'emp1@emp1.emp1', 'password' => 'emp1emp1'],
            ['name' => 'emp2emp2', 'email' => 'emp2@emp2.emp2', 'password' => 'emp2emp2'],


        ];

        $roles = [
            ['name' => 'Admin', 'role' => 'admin'],
            ['name' => 'Employee', 'role' => 'employee'],
        ];



        foreach ($roles as $role) {
            $createdRole = new \App\Role();
            $createdRole->name = $role['name'];
            $createdRole->role = $role['role'];
            $createdRole->save();
        }

        $adminRole = \App\Role::where('role', 'admin')->first();
        $employeeRole = \App\Role::where('role', 'employee')->first();


        foreach ($users as $user) {
            $createdUser = new \App\User();
            $createdUser->name = $user['name'];
            $createdUser->email = $user['email'];
            $createdUser->password = bcrypt($user['password']);

            $createdUser->save();
        }


        $users = \App\User::all();
        foreach ($users as $user) {
            if ($user['name'] === 'adminadmin') {
                $user->role()->associate($adminRole);

            } else {
                $user->role()->associate($employeeRole);

                for ($i = 1; $i <= 3; $i++) {

                    $customer = new \App\Customer();
                    $customer->first_name = $faker->firstName();
                    $customer->last_name = $faker->lastName();
                    $customer->employee()->associate($user);
                    $customer->save();
                }

//                $user->customers()->associste($customer);
            }
            $user->save();
        }

        $types = [
            ['name' => 'Call', 'type' => 'call'],
            ['name' => 'Visit', 'type' => 'visit'],
            ['name' => 'Follow up', 'type' => 'followup'],
        ];



        foreach ($types as $type) {
            $createdType = new \App\Type();
            $createdType->name = $type['name'];
            $createdType->type = $type['type'];
            $createdType->save();
        }



    }
}
