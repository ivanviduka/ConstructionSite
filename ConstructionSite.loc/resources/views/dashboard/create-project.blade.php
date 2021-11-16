@extends('layouts.dashboard')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-6 col-xs-12">

                <div class="card border-2 border-primary">

                    <div class="card-body">
                        <form method="POST" action="{{ route('project.create') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="project_name" class="form-label">Project Name</label>
                                <input type="text" class="form-control" id="project_name" name="project_name"
                                       required autofocus>
                                @if ($errors->has('project_name'))
                                    <span class="text-danger">{{ $errors->first('project_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="street_address" class="form-label">Street Address</label>
                                <input type="text" id="street_address" class="form-control"
                                       name="address" required autofocus>
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" id="city" class="form-control" name="city" required autofocus>
                                @if ($errors->has('city'))
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3" id="type_buttons">
                                <label class="form-label"> Select project type</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="project_type" value="building"
                                           id="building_rb" checked>
                                    <label class="form-check-label" for="building_rb">Building</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="project_type" value="house"
                                           id="house_rb">
                                    <label class="form-check-label" for="house_rb">House</label>
                                </div>

                                @if ($errors->has('project_type'))
                                    <span class="text-danger">{{ $errors->first('project_type') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="project_desc" class="form-label">Project Description</label>
                                <textarea class="form-control" id="project_desc" name="project_description"
                                          rows="3"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="control-label" for="start_date">Start Date</label>
                                <input class="form-control" id="start_date" name="start_date" type="date" required
                                       autofocus/>
                                @if ($errors->has('start_date'))
                                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label class="control-label" for="deadline_date">Deadline Date</label>
                                <input class="form-control" id="deadline_date" name="deadline_date" type="date"
                                       required autofocus>

                                @if ($errors->has('deadline_date'))
                                    <span class="text-danger">{{ $errors->first('deadline_date') }}</span>
                                @endif
                            </div>

                            <button class="btn btn-primary" type="submit">Create Project</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
