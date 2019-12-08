@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Visits
            <a href="{{ route('admin.visits.create') }}" class="btn btn-primary float-right">Add</a>
          </div>
          <div class="card-body">
            @if (count($visits) === 0)
              <p>There are no visits</p>
            @else
              <table id="table-visits" class="table table-hover">
                <thead>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Duration</th>
                  <th>Patient</th>
                  <th>Doctor</th>
                  <th>Cost</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  @foreach ($visits as $visit)
                    <tr data-id="{{ $visit->id }}" @if($visit->cancelled) class="table-danger" @endif>
                      <td>{{ $visit->date }} @if($visit->cancelled) <span class="badge badge-danger" style="padding: 8px;margin: 0 4px">CANCELLED</span> @endif</td>
                      <td>{{ $visit->time }}</td>
                      <td>{{ $visit->duration }}</td>
                      <td>{{ $visit->patient->user->name }}</td>
                      <td>{{ $visit->doctor->user->name }}</td>
                      <td>{{ $visit->cost }}</td>

                      <td>
                        <a href="{{ route('admin.visits.show', $visit->id) }}" class="btn btn-default">View</a>
                        <a href="{{ route('admin.visits.edit', $visit->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('admin.visits.cancel', $visit->id) }}" class="btn @if($visit->cancelled) disabled @endif btn-danger">Cancel</a>
                        <form style="display:inline-block" method="POST" action="{{ route('admin.visits.destroy', $visit->id) }}">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-minus-circle delete-icon"></i>
                          </button>

                        </form>
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
