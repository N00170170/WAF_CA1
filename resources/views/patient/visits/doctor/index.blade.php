@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Visits with {{ $doctor->user->name }}
          </div>
          <div class="card-body">
            @if (count($visits) === 0)
              <p>You have no visits with this doctor</p>
            @else
              <table id="table-visits" class="table table-hover">
                <thead>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Duration</th>
                  <th>Cost</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  @foreach ($visits as $visit)
                    <tr data-id="{{ $visit->id }}">
                      <td>{{ $visit->date }}</td>
                      <td>{{ $visit->time }}</td>
                      <td>{{ $visit->duration }}</td>
                      <td>{{ $visit->cost }}</td>

                      <td>
                        <a href="{{ route('doctor.visits.show', $visit->id) }}" class="btn btn-default">View</a>
                        <a href="{{ route('doctor.visits.edit', $visit->id) }}" class="btn btn-warning">Edit</a>
                        <form style="display:inline-block" method="POST" action="{{ route('doctor.visits.destroy', $visit->id) }}">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button type="submit" class="form-control btn btn-danger">Delete</a>
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
