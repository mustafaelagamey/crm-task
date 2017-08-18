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
        // creating faker instance to create faked fields
        $faker = Faker::create();


        //the roles of users in task
        $roles = [
            ['name' => 'Admin', 'role' => 'admin'],
            ['name' => 'Employee', 'role' => 'employee'],
        ];


        //creating roles and saving it
        foreach ($roles as $role) {
            $createdRole = new \App\Role();
            $createdRole->name = $role['name'];
            $createdRole->role = $role['role'];
            $createdRole->save();
        }

        //determine the task roles for seeding only
        $adminRole = \App\Role::where('role', 'admin')->first();
        $employeeRole = \App\Role::where('role', 'employee')->first();


        //test users admin and employees
        $users = [
            ['name' => 'adminadmin', 'email' => 'admin@admin.admin', 'password' => 'adminadmin'],
            ['name' => 'emp1emp1', 'email' => 'emp1@emp1.emp1', 'password' => 'emp1emp1'],
            ['name' => 'emp2emp2', 'email' => 'emp2@emp2.emp2', 'password' => 'emp2emp2'],


        ];
        //creating the test users
        foreach ($users as $user) {
            $createdUser = new \App\User();
            $createdUser->name = $user['name'];
            $createdUser->email = $user['email'];
            $createdUser->password = bcrypt($user['password']);

            $createdUser->save();

            //assign roles to users
            if ($user['name'] === 'adminadmin') {
                $createdUser->role()->associate($adminRole->id);

            } else {
                $createdUser->role()->associate($employeeRole->id);

                //create customer and assign them to employees
                for ($i = 1; $i <= rand(5,8); $i++) {
                    $customer = new \App\Customer();
                    $customer->first_name = $faker->firstName();
                    $customer->last_name = $faker->lastName();
                    $customer->employee()->associate($createdUser);
                    $customer->save();
                }
            }
            $createdUser->save();
            echo $createdUser->name . 'user saved';
        }

        //creating task action types
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
