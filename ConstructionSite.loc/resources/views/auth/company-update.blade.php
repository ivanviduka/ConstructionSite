@extends('layouts.dashboard')

@section('content')

    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <div class="card">
                    <h3 class="card-header text-center" style="background-color: #a0aec0">UPDATE COMPANY
                        INFORMATION</h3>
                    <div class="card-body">

                        <form action="{{ route('update.custom') }}" method="POST">

                            @csrf
                            <div class="form-group mb-3">
                                <label for="company_name" class="col-sm-3 col-form-label">Company name</label>
                                <input type="text" value="{{auth()->user()->company_name}}" id="company_name"
                                       class="form-control" name="company_name" required autofocus>
                                @if ($errors->has('company_name'))
                                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="company_cid" class="col-sm-3 col-form-label">CID/Company OIB</label>
                                <input type="text" value="{{auth()->user()->company_cid}}" id="company_cid"
                                       class="form-control" name="company_cid" required autofocus>
                                @if ($errors->has('company_cid'))
                                    <span class="text-danger">{{ $errors->first('company_cid') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="email_address" class="col-sm-3 col-form-label">Company email</label>
                                <input type="email" value="{{auth()->user()->email}}" id="email_address"
                                       class="form-control" name="email" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="street_address" class="col-sm-3 col-form-label">Address</label>
                                <input type="text" value="{{auth()->user()->address}}" id="street_address"
                                       class="form-control" name="address" required autofocus>
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="city" class="col-sm-3 col-form-label">City</label>
                                <input type="text" value="{{auth()->user()->city}}" id="city"
                                       class="form-control" name="city" required autofocus>
                                @if ($errors->has('city'))
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

@endsection
