<!DOCTYPE html>
<html lang="en">
<head>
    <title>Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="description" content="Authentication for ConstructionSite web page">

</head>

<body>

<nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #2d3344;">
    <div class="container">

        <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
            <ul class="nav justify-content-center">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" style="color: #cbd5e0" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #cbd5e0" href="{{ route('register-user') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" style="color: #cbd5e0" href="{{ route('signout') }}">Logout</a>
                    </li>

                @endguest
            </ul>

        </div>
    </div>



</nav>

@yield('content')

</body>

</html>
