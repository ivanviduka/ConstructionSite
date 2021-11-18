<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="description" content="List of projects and information about them">
</head>

<body>

<nav class="navbar navbar-light navbar-expand-lg mb-5 d-flex justify-content-between"
     style="background-color: #a0aec0;">

    <div class="d-flex justify-content-end ms-4">
        <a class="navbar-brand" href="{{route('project.create.form')}}">
            <button class="btn btn-primary" type="button"> New project</button>
        </a>
    </div>

    <div class="d-flex justify-content-center" style="margin-left: 90px">
        <a class="navbar-brand" href="{{route("homepage")}}">
            <img class="border border-dark" src="{{asset('/img/Logo.png')}}" alt="Company logo" width="200px"
                 height="150px">
        </a>
    </div>

    <div class="d-flex justify-content-center">
        <h2 class="mt-2 pe-2 border-dark border-end">{{auth()->user()->company_name }}</h2>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" style="color: #cbd5e0" href="{{ route('update.company') }}">
                    <button class="btn btn-primary" type="button">Company info</button>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: #cbd5e0" href="{{ route('change.password') }}">
                    <button class="btn btn-primary " type="button">Change Password</button>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: #cbd5e0" href="{{ route('signout') }}">
                    <button class="btn btn-dark me-1" type="button">Logout</button>
                </a>
            </li>
        </ul>
    </div>

</nav>

@yield('content')

</body>

</html>
