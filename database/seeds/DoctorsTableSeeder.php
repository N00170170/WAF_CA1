<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Doctor;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_doctor = Role::where('name', 'doctor')->first();

        foreach ($role_doctor->users as $user) {
          $doctor = new Doctor();
          $doctor->start_date = '2019-11-21';
          $doctor->user_id = $user->id;
          $doctor->save();
        }
    }

}
