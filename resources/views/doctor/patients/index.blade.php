@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            My Patients
          </div>
          <div class="card-body">
            @if (count($visits) === 0)
            <p>You have no patients</p>
            @else
              <table id="table-patients" class="table table-hover">
                <thead>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Insurance</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  @foreach ($visits->unique('patient_id') as $visit)
                    <tr data-id="{{ $visit->patient->user->id }}">
                      <td>{{ $visit->patient->user->name }}</td>
                      <td>{{ $visit->patient->user->address }}</td>
                      <td>{{ $visit->patient->user->email }}</td>
                      <td>@if($visit->patient->hasInsurance) {{ $visit->patient->insurance_company->company_name }} @else None @endif</td>
                      <td>
                        <a href="{{ route('doctor.visits.patient.index', $visit->patient->id) }}" class="btn btn-default">View Visits</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
