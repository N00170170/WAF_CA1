@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="card">
          <div class="card-header">
            Edit insurance company
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
            <form method="POST" action="{{ route('admin.insurancecompanies.update', $insurance_company->id) }}">
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label for="company_name">Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $insurance_company->company_name) }}" />
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $insurance_company->phone) }}" />
              </div>
              <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ old('website', $insurance_company->website) }}" />
              </div>
              <a href="{{ route('admin.insurancecompanies.index') }}" class="btn btn-outline">Cancel</a>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
