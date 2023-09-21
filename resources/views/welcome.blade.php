<!doctype html>
<html dir="{{App::isLocale('ar')? 'rtl' : 'ltr'}}" lang="{{App::currentLocale()}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Google Classroom</title>
    <link rel="icon" type="image/x-icon" href="{{asset('imgs/Google_Classroom_Logo.svg.png')}}" />
    @if (App::currentLocale() == 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    @endif
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://kit.fontawesome.com/6cb271fdf5.js" crossorigin="anonymous"></script>
</head>



<body>

    <header>
        <nav class="navbar navbar-expand-md bd-light">
            <div class="container">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="navbar-brand text-secondary fs-4" href="{{route('classrooms.index')}}">Google <span class="text-success">Classroom</span></a>
                    </li>
                </ul>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item d-flex">
                            @if (Route::has('login'))
                            @if (auth()->guard('admin')->check() || auth()->guard('web')->check())
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                            @else
                            <a class="nav-link" href="{{ route('login') }}">Log in</a>
                            @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                            @endif
                            @endif
                            @endif

                        </li>

                    </ul>

                </div>

            </div>
        </nav>
    </header>

    <main class="contanier m-auto w-75 bg-white pt-5">

        <div class="p-5 content m-auto w-75 text-center">
            <img src="{{asset('imgs/Google_Classroom_Logo.svg.png')}}" alt="" class="w-25">
            <h2 class="mt-4">Welcome to Google Classroom ,<br>
                Here you can Join Classess and Learn..</h2>

                <div class="action d-flex m-auto justify-content-center">
                <a href="{{route('plans')}}" class="btn btn-success mt-4 me-3">View Plans</a>
                <a href="{{route('classrooms.index')}}" class="btn btn-success mt-4">View Classrooms</a>
                </div>
        </div>
    </main>

    <scrip src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>