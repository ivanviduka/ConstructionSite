@extends('layouts.project-details')

@section('title')
    <title>Problem list</title>
@endsection

@section('creation-text')
    <div class="d-flex justify-content-end ms-4">
        <a class="navbar-brand" href="{{ route('problem.create.form') }}">
            <button class="btn btn-primary" type="button">Add problem</button>
        </a>
    </div>
@endsection

@section('content')

    <h1 class="text-center">{{$apartmentDetails->name}}</h1>

    <div class="container mb-5" style="font-size: 20px">
        <ul class="list-unstyled">
            <li><strong>Address: </strong> {{ $apartmentDetails->address }}, {{ $apartmentDetails->city }}</li>
            <li><strong>Floor: </strong> {{ $apartmentDetails->floor }}</li>
            <li><strong>Squarespace: </strong> {{ $apartmentDetails->squarespace }} m<sup>2</sup></li>
        </ul>
    </div>

    @if (count($problems) > 0)
        <div class="panel panel-default m-5">
            <div class="panel-body">
                <h2>Active Projects</h2>
                <table class="table table-hover mt-4 ">

                    <thead>
                    <th scope="col">Images</th>
                    <th scope="col">Room where problem is detected</th>
                    <th scope="col">Date of detection</th>
                    <th scope="col">Deadline for resolving problem</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                    </thead>

                    <tbody>
                    @foreach ($problems as $problem)
                        @if($problem->is_repaired)
                            <tr class="border-bottom-2 border border-dark table-success">
                        @else
                            <tr class="border-bottom-2 border-dark">
                                @endif

                                <td class="table-text">
                                    @foreach(explode(',', $problem->filepath) as $imageSource)
                                        <img class="img-fluid img-thumbnail" src="{{asset('images/'.$imageSource)}}"
                                             alt="Problem images">

                                    @endforeach

                                </td>

                                <td class="table-text">
                                    {{$problem->apartment_area}}
                                </td>

                                <td class="table-text">
                                    <div>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$problem->problem_recorded_date)->format('d.m.Y') }}</div>
                                </td>

                                @if(\Carbon\Carbon::createFromDate($problem->repairing_deadline_date )->lt(\Carbon\Carbon::now()))
                                    <td class="table-text">
                                        <div>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$problem->repairing_deadline_date )->format('d.m.Y') }}
                                            <span style="color: red; font-size: 25px">&#33;</span>
                                        </div>
                                    </td>
                                @elseif(\Carbon\Carbon::createFromDate($problem->repairing_deadline_date )->lt(\Carbon\Carbon::now()->addDays(14)))
                                    <td class="table-text">
                                        <div>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$problem->repairing_deadline_date)->format('d.m.Y') }}
                                            <span style="color: #ff870e; font-size: 25px">&#33;</span>
                                        </div>
                                    </td>
                                @else
                                    <td class="table-text">
                                        <div>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$problem->repairing_deadline_date )->format('d.m.Y') }}</div>
                                    </td>
                                @endif

                                <td class="table-text">
                                    <div>{{ $problem->description }}</div>
                                </td>

                                <td>
                                    <a href="/problem-info/{{$problem->id}}">
                                        <button class="btn btn-outline-secondary mb-2">Change details</button>
                                    </a>

                                    <form action="/update-problem/{{$problem->id}}" method="GET">
                                        @if($problem->is_repaired)
                                            <button class="btn btn-outline-danger mb-2">Incomplete</button>
                                        @else
                                            <button class="btn btn-outline-success mb-2">Done</button>
                                        @endif
                                    </form>

                                    <form action="/problem/{{$problem->id}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-outline-danger mb-2"
                                                onclick="return confirm('Are you sure you want to delete this problem?')">
                                            Delete problem
                                        </button>
                                    </form>

                                </td>

                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @else
        <div class="container">
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                     class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                     aria-label="Warning:">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0
                        1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1
                        5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div>
                    There aren't any recorded problems.
                    <a href="{{ route('problem.create.form') }}" class="alert-link"> Open first problem here. </a>
                </div>
            </div>
        </div>
    @endif
@endsection


