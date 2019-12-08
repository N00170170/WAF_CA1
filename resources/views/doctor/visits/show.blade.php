@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="card">
          <div class="card-header">
            Visit: {{ $patient->user->name }}
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
                    <td>Cost</td>
                    <td>{{ $visit->cost }}</td>
                  </tr>

                </tbody>
              </table>

              <a href="{{ route('doctor.visits.index') }}" class="btn btn-default">Back</a>
              <a href="{{ route('doctor.visits.edit', $visit->id) }}" class="btn btn-warning">Edit</a>
              <form style="display:inline-block" method="POST" action="{{ route('doctor.visits.destroy', $visit->id) }}">
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
