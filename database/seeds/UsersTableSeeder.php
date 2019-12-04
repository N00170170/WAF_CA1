<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_doctor = Role::where('name', 'doctor')->first();
        $role_patient = Role::where('name', 'patient')->first();

        $admin = new User();
        $admin->name = 'Admin';
        $admin->address = 'Main Street';
        $admin->phone = '0' . $this->random_str(2, '0123456789') . '-' . $this->random_str(7, '0123456789');
        $admin->email = 'admin@ultanmedicalcentre.ie';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $doctor = new User();
        $doctor->name = 'Doctor';
        $doctor->address = 'Main Street';
        $doctor->phone = '0' . $this->random_str(2, '0123456789') . '-' . $this->random_str(7, '0123456789');
        $doctor->email = 'doctor@ultanmedicalcentre.ie';
        $doctor->password = bcrypt('secret');
        $doctor->save();
        $doctor->roles()->attach($role_doctor);

        $doctor = new User();
        $doctor->name = 'Doctor 1';
        $doctor->address = 'Main Street';
        $doctor->phone = '0' . $this->random_str(2, '0123456789') . '-' . $this->random_str(7, '0123456789');
        $doctor->email = 'doctor1@ultanmedicalcentre.ie';
        $doctor->password = bcrypt('secret');
        $doctor->save();
        $doctor->roles()->attach($role_doctor);

        $patient = new User();
        $patient->name = 'Patient';
        $patient->address = 'Main Street';
        $patient->phone = '0' . $this->random_str(2, '0123456789') . '-' . $this->random_str(7, '0123456789');
        $patient->email = 'patient@ultanmedicalcentre.ie';
        $patient->password = bcrypt('secret');
        $patient->save();
        $patient->roles()->attach($role_patient);

        $patient = new User();
        $patient->name = 'Patient 1';
        $patient->address = 'Main Street';
        $patient->phone = '0' . $this->random_str(2, '0123456789') . '-' . $this->random_str(7, '0123456789');
        $patient->email = 'patient1@ultanmedicalcentre.ie';
        $patient->password = bcrypt('secret');
        $patient->save();
        $patient->roles()->attach($role_patient);
    }

    private function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
      $pieces = [];
      $max = mb_strlen($keyspace, '8bit') - 1;
      for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
      }
      return implode('', $pieces);
    }
}
