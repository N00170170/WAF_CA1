<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InsuranceCompany;

class InsuranceCompanyController extends Controller
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
      $insurancecompanies = InsuranceCompany::all();

      return view('admin.insurancecompanies.index')->with([
        'insurancecompanies' => $insurancecompanies
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.insurancecompanies.create');
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
        'company_name' => 'required',
        'phone' => 'required',
        'website' => 'required'
      ]);

      $insurancecompany = new InsuranceCompany();
      $insurancecompany->company_name = $request->input('company_name');
      $insurancecompany->phone = $request->input('phone');
      $insurancecompany->website = $request->input('website');

      $insurancecompany->save();

      return redirect()->route('admin.insurancecompanies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $insurancecompany = InsuranceCompany::findOrFail($id);

        return view('admin.insurancecompanies.show')->with([
          'insurancecompany' => $insurancecompany
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
      $insurancecompany = InsuranceCompany::findOrFail($id);

      return view('admin.insurancecompanies.edit')->with([
        'insurance_company' => $insurancecompany
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
      $insurancecompany = InsuranceCompany::findOrFail($id);

      $request->validate([
        'company_name' => 'required',
        'phone' => 'required',
        'website' => 'required'
      ]);

      $insurancecompany->company_name = $request->input('company_name');
      $insurancecompany->phone = $request->input('phone');
      $insurancecompany->website = $request->input('website');

      $insurancecompany->save();

      return redirect()->route('admin.insurancecompanies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $insurancecompany = InsuranceCompany::findOrFail($id);

      $insurancecompany->delete();

      return redirect()->route('admin.insurancecompanies.index');

    }
}
