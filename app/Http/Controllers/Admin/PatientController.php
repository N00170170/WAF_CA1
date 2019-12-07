<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Role;
use App\InsuranceCompany;


class PatientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $patients = Patient::all();

      return view('admin.patients.index')->with([
        'patients' => $patients
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insurancecompanies = InsuranceCompany::all();

        return view('admin.patients.create')->with([
          'insurancecompanies' => $insurancecompanies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required|max:191',
          'address' => 'required|max:191',
          'phone' => 'required|numeric',
          'email' => 'required|email|max:191|unique:users',
          'hasinsurance' => 'required|boolean',
          'insurance_company_id' => 'numeric',
          'policy_number' => ''

        ]);

        $role_patient = Role::where('name', 'patient')->first();

        $user = new User();
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = bcrypt('secret');

        $user->save();
        $user->roles()->attach($role_patient);


        $patient = new Patient();
        $patient->hasinsurance = $request->input('hasinsurance');
        //check whether insurace options should be inserted or not
        if ($patient->hasinsurance) {
          $patient->insurance_company_id = $request->input('insurance_company_id');
          $patient->policy_number = $request->input('policy_number');
        }
        $patient->user_id = $user->id;

        $patient->save();

        return redirect()->route('admin.patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $patient = Patient::findOrFail($id);

      return view('admin.patients.show')->with([
        'patient' => $patient
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $patient = Patient::findOrFail($id);
      $insurancecompanies = InsuranceCompany::all();

      return view('admin.patients.edit')->with([
        'patient' => $patient,
        'insurancecompanies' => $insurancecompanies
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $patient = Patient::findOrFail($id);
      $user = User::findOrFail($patient->user_id);

      $request->validate([
        'name' => 'required|max:191',
        'address' => 'required|max:191',
        'phone' => 'required',
        'email' => 'required|email|max:191|unique:users,email,' . $user->id,
        'hasinsurance' => 'required|boolean',
        'insurance_company_id' => 'numeric',
        'policy_number' => ''
      ]);

      $user->name = $request->input('name');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->email = $request->input('email');
      $user->password = bcrypt('secret');

      $user->save();

      $patient->hasinsurance = $request->input('hasinsurance');
      //check whether insurace options should be inserted or not
      if ($patient->hasinsurance) {
        $patient->insurance_company_id = $request->input('insurance_company_id');
        $patient->policy_number = $request->input('policy_number');
      } else {
        //nulling values in case the patient previously had insurance options set
        $patient->insurance_company_id = null;
        $patient->policy_number = null;
      }

      $patient->save();

      return redirect()->route('admin.patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // $patient = Patient::findOrFail($id);
      $user = User::findOrFail($id);


      $user->delete();

      return redirect()->route('admin.patients.index');
    }
}
