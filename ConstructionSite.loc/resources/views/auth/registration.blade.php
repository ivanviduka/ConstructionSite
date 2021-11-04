@extends('layouts.authentication')

@section('content')
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">

                    <div class="card">
                        <h3 class="card-header text-center" style="background-color: #a0aec0">REGISTER COMPANY</h3>
                        <div class="card-body">

                            <form action="{{ route('register.custom') }}" method="POST">

                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Company Name" id="name" class="form-control"
                                           name="company_name"
                                           required autofocus>
                                    @if ($errors->has('company_name'))
                                        <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" placeholder="CID/Company OIB" id="company_cid" class="form-control"
                                           name="company_cid"
                                           required autofocus>
                                    @if ($errors->has('company_cid'))
                                        <span class="text-danger">{{ $errors->first('company_cid') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <input type="email" placeholder="Company Email" id="email_address"
                                           class="form-control"
                                           name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Street Address" id="street_address"
                                           class="form-control"
                                           name="address" required autofocus>
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" placeholder="City" id="city"
                                           class="form-control"
                                           name="city" required autofocus>
                                    @if ($errors->has('city'))
                                        <span class="text-danger">{{ $errors->first('city') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control"
                                           name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Confirm Password" id="password_confirmation"
                                           class="form-control"
                                           name="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
