@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            My Doctors
          </div>
          <div class="card-body">
            @if (count($visits) === 0)
            <p>You have no doctors</p>
            @else
              <table id="table-doctors" class="table table-hover">
                <thead>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  @foreach ($visits->unique('doctor_id') as $visit)
                    <tr data-id="{{ $visit->doctor->user->id }}">
                      <td>{{ $visit->doctor->user->name }}</td>
                      <td>{{ $visit->doctor->user->phone }}</td>
                      <td>{{ $visit->doctor->user->email }}</td>
                      <td>
                        <a href="{{ route('patient.visits.doctor.index', $visit->doctor->id) }}" class="btn btn-default">View Visits</a>
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
