<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-light navbar-expand-lg mb-5 d-flex justify-content-between" style="background-color: #a0aec0;">

        <div class="d-flex justify-content-end ms-4">
            <a class="navbar-brand" href="#">
                <button class="btn btn-primary" type="button"> New project</button>
            </a>
        </div>

        <div>
            <img class="border border-dark" src="{{asset('/img/Logo.png')}}" alt="Company logo" width="180px" height="140px">
        </div>

        <div class="d-flex justify-content-center">
            <h2 class="mt-2 pe-2 border-dark border-end">{{auth()->user()->company_name }}</h2>
            <form class="container-fluid justify-content-end mt-2">
                <button class="btn btn-primary" type="button">Company info</button>
            </form>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" style="color: #cbd5e0" href="{{ route('signout') }}">
                        <button class="btn btn-primary me-2" type="button">Logout</button>
                    </a>
                </li>
            </ul>
        </div>

</nav>

@yield('content')

</body>

</html>
