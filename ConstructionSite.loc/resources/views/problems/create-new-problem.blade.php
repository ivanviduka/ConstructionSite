@extends('layouts.project-details')

@section('title')
    <title>New Problem</title>
@endsection

@section('creation-text')
    <div class="d-flex justify-content-end ms-4">
        <a class="navbar-brand" href="{{ route('problem.create.form') }}">
            <button class="btn btn-primary" type="button">Add problem</button>
        </a>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-6 col-xs-12">

                <div class="card border-2 border-primary">

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('problem.create') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="imagesUpload" class="form-label">Add pictures for problem</label>
                                <input class="form-control" type="file" id="imagesUpload" name="images[]" multiple>

                                @if ($errors->has('images'))
                                    <span class="text-danger">{{ $errors->first('images') }}</span>
                                @endif
                                @if ($errors->has('images.*'))
                                    <span class="text-danger">{{ $errors->first('images.*') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="apartment_room" class="form-label">Room where problem is detected</label>
                                <input type="text" class="form-control" id="apartment_room" name="apartment_room" required
                                       autofocus>
                                @if ($errors->has('apartment_room'))
                                    <span class="text-danger">{{ $errors->first('apartment_room') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="form-group mb-3">
                                    <label for="project_desc" class="form-label">Problem Description</label>
                                    <textarea class="form-control" id="project_desc" name="project_description"
                                              rows="3"></textarea>
                                </div>
                                @if ($errors->has('project_description'))
                                    <span class="text-danger">{{ $errors->first('project_description') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label class="control-label" for="repair_deadline">Repair Deadline</label>
                                <input class="form-control" id="repair_deadline" name="repair_deadline"
                                       type="date" min="{{\Carbon\Carbon::today()->format('Y-m-d')}}"
                                       value="{{\Carbon\Carbon::today()->format('Y-m-d')}}"required autofocus/>

                                @if ($errors->has('repair_deadline'))
                                    <span class="text-danger">{{ $errors->first('repair_deadline') }}</span>
                                @endif
                            </div>


                            <button class="btn btn-primary" type="submit">Add Problem</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>

@endsection
