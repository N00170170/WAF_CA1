<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Visit;
use App\Patient;
use App\Doctor;

class VisitController extends Controller
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
      $visits = Visit::all();

      return view('admin.visits.index')->with([
        'visits' => $visits
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('admin.visits.create')->with([
          'patients' => $patients,
          'doctors' => $doctors
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
          'date' => 'required|date',
          'time' => 'required',
          'duration' => 'required|numeric',
          'patient_id' => 'required|numeric',
          'doctor_id' => 'required|numeric',
          'cost' => 'required|numeric'
        ]);

        $visit = new Visit();
        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->duration = $request->input('duration');
        $visit->patient_id = $request->input('patient_id');
        $visit->doctor_id = $request->input('doctor_id');
        $visit->cost = $request->input('cost');

        $visit->save();

        return redirect()->route('admin.visits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $visit = Visit::findOrFail($id);
      $patient = Patient::findOrFail($visit->patient_id);
      $doctor = Doctor::findOrFail($visit->doctor_id);

      return view('admin.visits.show')->with([
        'visit' => $visit,
        'patient' => $patient,
        'doctor' => $doctor
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
      $visit = Visit::findOrFail($id);
      $patients = Patient::all();
      $doctors = Doctor::all();

      return view('admin.visits.edit')->with([
        'visit' => $visit,
        'patients' => $patients,
        'doctors' => $doctors
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
        $visit = Visit::findOrFail($id);

        $request->validate([
          'date' => 'required|date',
          'time' => 'required',
          'duration' => 'required|numeric',
          'patient_id' => 'required|numeric',
          'doctor_id' => 'required|numeric',
          'cost' => 'required|numeric'
        ]);

        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->duration = $request->input('duration');
        $visit->patient_id = $request->input('patient_id');
        $visit->doctor_id = $request->input('doctor_id');
        $visit->cost = $request->input('cost');

        $visit->save();

        return redirect()->route('admin.visits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $visit = Visit::findOrFail($id);

      $visit->delete();

      return redirect()->route('admin.visits.index');
    }

    public function cancel($id)
    {
      $visit = Visit::findOrFail($id);

      $visit->cancelled = true;
      $visit->save();

      return redirect()->route('admin.visits.index');
    }
}
