@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="card">
          <div class="card-header">
            Visit: {{ $patient->user->name }} with {{ $doctor->user->name }} @if($visit->cancelled) <span class="badge badge-danger" style="padding: 8px;margin: 0 4px">CANCELLED</span> @endif
          </div>
          <div class="card-body">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td>Date</td>
                    <td>{{ $visit->date }}</td>
                  </tr>
                  <tr>
                    <td>Time</td>
                    <td>{{ $visit->time }}</td>
                  </tr>
                  <tr>
                    <td>Duration</td>
                    <td>{{ $visit->duration }}</td>
                  </tr>
                  <tr>
                    <td>Patient</td>
                    <td>{{ $patient->user->name }}</td>
                  </tr>
                  <tr>
                    <td>Doctor</td>
                    <td>{{ $doctor->user->name }}</td>
                  </tr>
                  <tr>
                    <td>Cost</td>
                    <td>{{ $visit->cost }}</td>
                  </tr>

                </tbody>
              </table>

              <a href="{{ route('admin.visits.index') }}" class="btn btn-default">Back</a>
              <a href="{{ route('admin.visits.edit', $visit->id) }}" class="btn btn-warning">Edit</a>
              <a href="{{ route('admin.visits.cancel', $visit->id) }}" class="btn @if($visit->cancelled) disabled @endif btn-danger">Cancel</a>
              <form style="display:inline-block" method="POST" action="{{ route('admin.visits.destroy', $visit->id) }}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="form-control btn btn-danger">Delete</a>
              </form>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
