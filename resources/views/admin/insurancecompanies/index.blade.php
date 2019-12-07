@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Insurance Companies
            <a href="{{ route('admin.insurancecompanies.create') }}" class="btn btn-primary float-right">Add</a>
          </div>
          <div class="card-body">
            @if (count($insurancecompanies) === 0)
              <p>There are no insurance companies</p>
            @else
              <table id="table-insurance-companies" class="table table-hover">
                <thead>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Website</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  @foreach ($insurancecompanies as $insurancecompany)
                    <tr data-id="{{ $insurancecompany->id }}">
                      <td>{{ $insurancecompany->company_name }}</td>
                      <td>{{ $insurancecompany->phone }}</td>
                      <td><a href="{{ $insurancecompany->website }}">{{ $insurancecompany->website }}</a></td>

                      <td>
                        <a href="{{ route('admin.insurancecompanies.show', $insurancecompany->id) }}" class="btn btn-default">View</a>
                        <a href="{{ route('admin.insurancecompanies.edit', $insurancecompany->id) }}" class="btn btn-warning">Edit</a>
                        <form style="display:inline-block" method="POST" action="{{ route('admin.insurancecompanies.destroy', $insurancecompany->id) }}">
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
