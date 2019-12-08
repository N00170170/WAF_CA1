@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="card">
          <div class="card-header">
            Add new visit
          </div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="POST" action="{{ route('doctor.visits.store') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" />
              </div>
              <div class="form-group">
                <label for="time">Time</label>
                <input type="time" class="form-control" id="time" name="time" value="{{ old('time') }}" />
              </div>
              <div class="form-group">
                <label for="duration">Duration</label>
                <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration') }}" />
              </div>
              <div class="form-group">
                <label for="patient">Patient</label>
                <select class="form-control" name="patient_id">
                  @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}" {{ (old('patient_id') == $patient->id) ? "selected" : "" }} >
                      {{ $patient->user->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="cost">Cost</label>
                <input type="number" step="0.01" class="form-control" id="cost" name="cost" value="{{ old('cost') }}" />
              </div>
              <a href="{{ route('doctor.visits.index') }}" class="btn btn-outline">Cancel</a>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
