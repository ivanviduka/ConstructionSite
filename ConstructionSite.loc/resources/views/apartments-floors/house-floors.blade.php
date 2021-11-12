@extends('layouts.project-details')


@section('title')
    <title>House Details</title>
@endsection

@section('creation-text')
    <div class="d-flex justify-content-end ms-4">
        <a class="navbar-brand" href="{{route('floor.create.form')}}">
            <button class="btn btn-primary" type="button">Add floor</button>
        </a>
    </div>
@endsection

@section('content')
    @if(!empty($apartmentInfo))
        <h1 class="text-center">{{$apartmentInfo->apartment_name}}</h1>

        <div class="container mb-5">
            <ul class="list-unstyled">
                <li><strong>Address: </strong> {{ $apartmentInfo->address }}, {{ $apartmentInfo->city }}</li>
                <li>
                    <strong>Construction
                        time: </strong> {{ \Carbon\Carbon::createFromFormat('Y-m-d',$apartmentInfo->start_date)->format('d.m.Y') }}
                    - {{ \Carbon\Carbon::createFromFormat('Y-m-d',$apartmentInfo->deadline_date)->format('d.m.Y') }}
                </li>
            </ul>
            <div>
                <strong>Description: </strong> {{$apartmentInfo->description}}
            </div>
        </div>
    @endif

    @if (count($apartments) > 0)
        <div class="container">
            <div class="row d-flex justify-content-center">
                <table class="table table-sm table-bordered border border-dark border-1 mt-4">

                    <thead>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Floor</th>
                    <th class="text-center" scope="col">Square room (m<sup>2</sup>)</th>
                    <th class="text-center" scope="col"></th>
                    </thead>

                    <tbody>
                    @foreach ($apartments as $apartment)
                        <tr>
                            <td class="table-text text-center">
                                {{ $apartment->name }}
                            </td>

                            <td class="table-text text-center">
                                {{ $apartment->floor }}
                            </td>

                            <td class="table-text text-center">
                                {{ $apartment->squarespace }}
                            </td>

                            <td class="table-text">
                                <a href="/apartment-info/{{$apartment->id}}">
                                    <button class="btn btn-outline-secondary ms-2">Update info</button>
                                </a>

                            </td>
                        </tr>
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
                    You don't have any flooring for this house <a href="{{ route('floor.create.form') }}"
                                                                  class="alert-link">Add first floor</a>.
                </div>
            </div>
        </div>
    @endif
@endsection

