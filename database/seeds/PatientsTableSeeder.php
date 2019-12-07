<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Patient;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_patient = Role::where('name', 'patient')->first();

      foreach ($role_patient->users as $user) {
        $patient = new Patient();
        $patient->hasInsurance = false;
        $patient->user_id = $user->id;
        $patient->save();
      }
    }
}
