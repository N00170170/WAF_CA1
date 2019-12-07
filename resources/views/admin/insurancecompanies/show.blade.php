@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="card">
          <div class="card-header">
            Insurance Company: {{ $insurancecompany->company_name }}
          </div>
          <div class="card-body">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td>Name</td>
                    <td>{{ $insurancecompany->company_name }}</td>
                  </tr>
                  <tr>
                    <td>Phone</td>
                    <td>{{ $insurancecompany->phone }}</td>
                  </tr>
                  <tr>
                    <td>Website</td>
                    <td><a href="{{ $insurancecompany->website }}">{{ $insurancecompany->website }}</a></td>
                  </tr>

                </tbody>
              </table>

              <a href="{{ route('admin.insurancecompanies.index') }}" class="btn btn-default">Back</a>
              <a href="{{ route('admin.insurancecompanies.edit', $insurancecompany->id) }}" class="btn btn-warning">Edit</a>
              <form style="display:inline-block" method="POST" action="{{ route('admin.insurancecompanies.destroy', $insurancecompany->id) }}">
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
