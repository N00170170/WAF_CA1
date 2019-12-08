<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Visit;
use App\Patient;
use App\Doctor;
use App\Role;
use Auth;

class VisitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:doctor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $doctor = $user->doctor;
      $visits = Visit::where('doctor_id', $doctor->id)->get();

      return view('doctor.visits.index')->with([
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

        return view('doctor.visits.create')->with([
          'patients' => $patients
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
        //set the variable doctor_id equal to the id of the currently logged in doctor
        $user = Auth::user();

        //validate the form data
        $request->validate([
          'date' => 'required|date',
          'time' => 'required',
          'duration' => 'required|numeric',
          'patient_id' => 'required|numeric',
          'cost' => 'required|numeric'
        ]);

        $visit = new Visit();
        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->duration = $request->input('duration');
        $visit->patient_id = $request->input('patient_id');
        $visit->doctor_id = $user->doctor->id;
        $visit->cost = $request->input('cost');

        $visit->save();

        return redirect()->route('doctor.visits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = Auth::user();
      // $visit = Visit::where('id', $id)->where('doctor_id', $user->doctor->id)->first();
      // $visit = Visit::where('doctor_id', $user->doctor->id)->findOrFail($id);
      $visit = Visit::findOrFail($id);

      //check if the visit belongs to the doctor
      if($visit->doctor_id === $user->doctor->id)
      {
        $patient = Patient::findOrFail($visit->patient_id);

        return view('doctor.visits.show')->with([
          'visit' => $visit,
          'patient' => $patient
        ]);
      } else {
        //redirect to index if visit doesn't belong to doctor
        return redirect()->route('doctor.visits.index');
      }
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

      return view('doctor.visits.edit')->with([
        'visit' => $visit,
        'patients' => $patients
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
          'cost' => 'required|numeric'
        ]);

        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->duration = $request->input('duration');
        $visit->patient_id = $request->input('patient_id');
        $visit->doctor_id = $visit->doctor->id;
        $visit->cost = $request->input('cost');

        $visit->save();

        return redirect()->route('doctor.visits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
      $visit = Visit::findOrFail($id);

      $visit->status = 'cancelled';
      $visit->save();

      return redirect()->route('doctor.visits.index');
    }

    public function mypatients()
    {
      $user = Auth::user();
      $doctor = $user->doctor;
      $visits = Visit::where('doctor_id', $doctor->id)->get();
      // $visits = Visit::where('doctor_id', $doctor->id)->goupBy('patient_id')->get();

      return view('doctor.patients.index')->with([
        'visits' => $visits
      ]);
    }

    public function visitswithpatient($id)
    {
      $user = Auth::user();
      // $visit = Visit::where('id', $id)->where('doctor_id', $user->doctor->id)->first();
      // $visit = Visit::where('doctor_id', $user->doctor->id)->findOrFail($id);
      $visits = Visit::where('patient_id', $id)->where('doctor_id', $user->doctor->id)->get();

      $patient = Patient::findOrFail($id);

      return view('doctor.visits.patient.index')->with([
        'visits' => $visits,
        'patient' => $patient
      ]);
    }
}
