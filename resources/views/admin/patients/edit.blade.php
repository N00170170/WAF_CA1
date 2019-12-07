@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="card">
          <div class="card-header">
            Edit patient
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
            <form method="POST" action="{{ route('admin.patients.update', $patient->id) }}">
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $patient->user->name) }}" />
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $patient->user->address) }}" />
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $patient->user->phone) }}" />
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $patient->user->email) }}" />
              </div>
              <div class="form-group">
                <label for="hasinsurance">Insurance</label><br>
                <input type="radio" name="hasinsurance" value="1" onclick="show();" @if($patient->hasInsurance) checked="true" @endif> Yes
                <input type="radio" name="hasinsurance" value="0" onclick="hide();" @if(!$patient->hasInsurance) checked="true" @endif> No<br>
              </div>

              <!-- Insurance options -->
              <div id="insuranceoptions">
                <div class="form-group">
                  <label for="insurancecompany">Insurance Company</label>
                  <select class="form-control" name="insurance_company_id">
                    @foreach ($insurancecompanies as $insurancecompany)
                      <option value="{{ $insurancecompany->id }}" {{ (old('insurance_company_id', $patient->insurance_company->id) == $insurancecompany->id) ? "selected" : "" }} >
                        {{ $insurancecompany->company_name }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="policy_number">Policy Number</label>
                  <input type="text" class="form-control" id="policy_number" name="policy_number" value="{{ old('policy_number', $patient->policy_number) }}" />
                </div>
              </div>
              <a href="{{ route('admin.patients.index') }}" class="btn btn-outline">Cancel</a>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      function hide(){
        document.getElementById('insuranceoptions').style.display ='none';
      }
      function show(){
        document.getElementById('insuranceoptions').style.display = 'block';
      }
      @if(!$patient->hasInsurance)
        hide();
      @endif
    </script>
  </div>


@endsection
