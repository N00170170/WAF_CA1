<?php

namespace App\Http\Controllers\Patient;

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
        $this->middleware('role:patient');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $patient = $user->patient;
      $visits = Visit::where('patient_id', $patient->id)->get();

      return view('patient.visits.index')->with([
        'visits' => $visits
      ]);
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
      if($visit->patient_id === $user->patient->id)
      {
        $doctor = Doctor::findOrFail($visit->doctor_id);

        return view('patient.visits.show')->with([
          'visit' => $visit,
          'doctor' => $doctor
        ]);
      } else {
        //redirect to index if visit doesn't belong to doctor
        return redirect()->route('doctor.visits.index');
      }
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

    public function mydoctors()
    {
      $user = Auth::user();
      $patient = $user->patient;
      $visits = Visit::where('patient_id', $patient->id)->get();
      // $visits = Visit::where('doctor_id', $doctor->id)->goupBy('patient_id')->get();

      return view('patient.doctors.index')->with([
        'visits' => $visits
      ]);
    }

    public function visitswithdoctor($id)
    {
      $user = Auth::user();
      // $visit = Visit::where('id', $id)->where('doctor_id', $user->doctor->id)->first();
      // $visit = Visit::where('doctor_id', $user->doctor->id)->findOrFail($id);
      $visits = Visit::where('doctor_id', $id)->where('patient_id', $user->patient->id)->get();

      $doctor = Doctor::findOrFail($id);

      return view('patient.visits.doctor.index')->with([
        'visits' => $visits,
        'doctor' => $doctor
      ]);
    }
}
