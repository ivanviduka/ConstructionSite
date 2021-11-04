@extends('authentication')

@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center" style="background-color: #a0aec0">LOGIN</h3>
                        <div class="card-body">

                            <form method="POST" action="{{ route('login.custom') }}">
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $message)
                                            {{$message}}
                                        @endforeach
                                    </div>
                                @endif
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                                {{session()->get('success')}}
                                    </div>
                                @endif

                                @csrf
                                <div class="row mb-4">
                                    <label for="company_name" class="col-sm-3 col-form-label">Company name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="company_name" id="company_name"
                                               required>
                                        @if ($errors->has('company_name'))
                                            <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                        @endif
                                    </div>

                                </div>

                                <div class="row mb-4">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password" id="password"
                                               required>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
