<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Patient;
use App\InsuranceCompany;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    //Override the default Laravel vendor register function to pass through insurance companies
    public function showRegistrationForm()
    {
      $insurancecompanies = InsuranceCompany::all();

      return view('auth.register')->with([
        'insurancecompanies' => $insurancecompanies
      ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      return Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
          'address' => ['required'],
          'phone' => ['required', 'string'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'hasinsurance' => ['required', 'boolean'],
          'insurance_company_id' => ['numeric'],
          'policy_number' => [],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //Commented out as could not get if statement to work, used code structure from PatientsController for creating a patient instead
        // $user = User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'address' => $data['address'],
        //     'phone' => $data['phone'],
        //     'password' => Hash::make($data['password']),
        // ]);
        //
        // $patient = Patient::create([
        //     'user_id' => $user->id,
        //     'hasInsurance' => $data['hasinsurance'],
        //     @if($data['hasInsurance']) {
        //       'insurance_company_id' => $data['insurance_company_id'],
        //       'policy_number' => $data['policy_number'],
        //     }
        // ]);
        //
        // $user->roles()->attach(Role::where('name', 'patient')->first());
        //
        // return $user;

        //Create user and save
        $user = new User();
        $user->name = $data['name'];
        $user->address = $data['address'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        //Create patient and save
        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->hasinsurance = $data['hasinsurance'];
        //check whether insurace options should be inserted or not
        if ($patient->hasinsurance) {
          $patient->insurance_company_id = $data['insurance_company_id'];
          $patient->policy_number = $data['policy_number'];
        }
        $patient->save();

        //Attach patient role to the user
        $user->roles()->attach(Role::where('name', 'patient')->first());

        return $user;
    }
}
