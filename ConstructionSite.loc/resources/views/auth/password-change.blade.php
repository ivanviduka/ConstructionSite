@extends('layouts.dashboard')

@section('content')

    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <div class="card">
                    <h3 class="card-header text-center" style="background-color: #a0aec0">CHANGE PASSWORD</h3>
                    <div class="card-body">

                        <form action="{{ route('update.password') }}" method="POST">

                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{session()->get('error')}}
                                </div>
                            @endif

                            @csrf
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Current Password" id="current_password"
                                       class="form-control"
                                       name="current_password" required>
                                @if ($errors->has('current_password'))
                                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="New Password" id="new_password" class="form-control"
                                       name="new_password" required>
                                @if ($errors->has('new_password'))
                                    <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Confirm New Password" id="new_password_confirmation"
                                       class="form-control"
                                       name="new_password_confirmation" required>
                                @if ($errors->has('new_password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('new_password_confirmation') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-primary btn-block">Change password</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
