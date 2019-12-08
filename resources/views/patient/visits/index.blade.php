@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            My Visits
          </div>
          <div class="card-body">
            @if (count($visits) === 0)
              <p>You have no visits</p>
            @else
              <table id="table-visits" class="table table-hover">
                <thead>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Duration</th>
                  <th>Doctor</th>
                  <th>Cost</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  @foreach ($visits as $visit)
                    <tr data-id="{{ $visit->id }}">
                      <td>{{ $visit->date }}</td>
                      <td>{{ $visit->time }}</td>
                      <td>{{ $visit->duration }}</td>
                      <td>{{ $visit->doctor->user->name }}</td>
                      <td>{{ $visit->cost }}</td>
                      <td>
                        <a href="{{ route('patient.visits.show', $visit->id) }}" class="btn btn-default">View</a>
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
