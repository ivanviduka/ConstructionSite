@extends('layouts.dashboard')


@section('content')

    @if (count($projects) > 0)
        <div class="panel panel-default m-5">
            <div class="panel-body">
                <h2>Active Projects</h2>
                <table class="table table-hover mt-4 ">

                    <thead>
                    <th scope="col">Project Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Deadline Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                    </thead>

                    <tbody>
                    @foreach ($projects as $project)
                        @if(!$project->is_finished)
                        <tr>
                            <td class="table-text">
                                <a href="#">{{ $project->project_name }}</a>
                            </td>

                            <td class="table-text">
                                {{ $project->address }}, {{ $project->city }}
                            </td>

                            <td class="table-text">
                                <div>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$project->start_date)->format('d.m.Y') }}</div>
                            </td>

                            <td class="table-text">
                                <div>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$project->deadline_date)->format('d.m.Y') }}</div>
                            </td>

                            <td class="table-text">
                                <div>{{ $project->project_type }}</div>
                            </td>

                            <td class="table-text">
                                <div>{{ $project->description }}</div>
                            </td>

                            <td>
                                <!-- TODO -- UPDATE FILE NAME -->
                                <form action="" method="GET">
                                    <button class="btn btn-outline-secondary mb-2">Update Project</button>
                                </form>

                                <form action="" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-outline-success mb-2"
                                            >Completed</button>
                                </form>

                                <form action="" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-outline-danger mb-2"
                                            onclick="return confirm('Are you sure you want to delete this Project?')">Delete project</button>
                                </form>

                            </td>

                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default ms-5 me-5">
            <div class="panel-body">
                <h2>Finished Projects</h2>
                <table class="table table-hover mt-4 ">

                    <thead>
                    <th scope="col">Project Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Deadline Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                    </thead>

                    <tbody>
                    @foreach ($projects as $project)
                        @if($project->is_finished)
                            <tr>
                                <td class="table-text">
                                    <a href="#">{{ $project->project_name }}</a>
                                </td>

                                <td class="table-text">
                                    {{ $project->address }}, {{ $project->city }}
                                </td>

                                <td class="table-text">
                                    <div>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$project->start_date)->format('d.m.Y') }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$project->deadline_date)->format('d.m.Y') }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $project->project_type }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $project->description }}</div>
                                </td>

                                <td>

                                    <form action="" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-outline-danger mb-2">In progress</button>
                                    </form>

                                    <form action="" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-outline-danger mb-2"
                                                onclick="return confirm('Are you sure you want to delete this Project?')">Delete project</button>
                                    </form>

                                </td>

                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    @else
        <div class="container">
            <div class="alert alert-dark d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                     class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                     aria-label="Warning:">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0
                        1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1
                        5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div>
                    You don't have any construction projects <a href="{{ route('project.create.form') }}" class="alert-link">Add your
                        first project </a>.
                </div>
            </div>
        </div>
    @endif
@endsection
