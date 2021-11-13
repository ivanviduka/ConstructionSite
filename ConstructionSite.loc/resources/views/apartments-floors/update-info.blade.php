@extends('layouts.project-details')

@section('title')
    <title>Update Information</title>
@endsection

@section('creation-text')
    <div class="d-flex justify-content-end ms-4">
        <a class="navbar-brand" href="{{route('apartment.create.form')}}">
            <button class="btn btn-primary" type="button">Add apartment</button>
        </a>
    </div>
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-6 col-xs-12">

                <div class="card border-2 border-primary">
                    <h2 class=" text-center">Update </h2>
                    <div class="card-body">
                        <form method="POST" action="{{ route('apartment.update') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="apartment_name" class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{$apartment->name}}" id="apartment_name"
                                       name="apartment_name" required autofocus>
                                @if ($errors->has('apartment_name'))
                                    <span class="text-danger">{{ $errors->first('apartment_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="apartment_floor" class="form-label">Floor</label>
                                <input type="number" id="apartment_floor" value="{{$apartment->floor}}"
                                       class="form-control" name="apartment_floor" required autofocus>
                                @if ($errors->has('apartment_floor'))
                                    <span class="text-danger">{{ $errors->first('apartment_floor') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="apartment_size" class="form-label">Size (m<sup>2</sup>)</label>
                                <input type="number" min="0" id="apartment_size" value="{{$apartment->squarespace}}"
                                       class="form-control" name="apartment_size" required autofocus>
                                @if ($errors->has('apartment_size'))
                                    <span class="text-danger">{{ $errors->first('apartment_size') }}</span>
                                @endif
                            </div>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>

@endsection
