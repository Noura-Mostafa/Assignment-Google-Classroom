<!doctype html>
<html dir="{{App::isLocale('ar')? 'rtl' : 'ltr'}}" lang="{{App::currentLocale()}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title' , config('app.name'))</title>
    @if (App::currentLocale() == 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    @endif
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://kit.fontawesome.com/6cb271fdf5.js" crossorigin="anonymous"></script>

    <script>
        function copyText() {
            const text = document.getElementById('textToCopy').innerText;

            const tempInput = document.createElement('input');
            tempInput.type = 'text';
            tempInput.value = text;

            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

        }
    </script>

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-md bg-body-tertiary">
            <div class="container">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="navbar-brand text-secondary fs-4" href="{{route('classrooms.index')}}">
                            <img src="{{asset('imgs/googlelogo_clr_74x24px.svg')}}" alt="Logo" class="d-inline-block align-text-center">
                            Classroom</a>
                    </li>
                </ul>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('classrooms.show' , $classroom->id)}}">{{__('Stream')}}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('classrooms.people' , $classroom->id)}}">{{__('People')}}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('classrooms.classworks.index' , $classroom->id)}}">{{__('Classwork')}}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">{{__('Grade')}}</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('classrooms.create')}}">{{__('Create Class')}}</a></li>
                                <li><a class="dropdown-item" href="{{route('classrooms.trashed')}}">{{__('Trashed')}}</a></li>
                                <li><a class="dropdown-item" href="{{route('profiles.create')}}">{{__('Profile')}}</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}">{{ Auth::user()->name }}</a>
                        </li>

                        <x-user-notification-menu />

                    </ul>

                </div>
            </div>
        </nav>


    </header>

    <main>
        @yield('content')
    </main>



    <script>
        var classroomId;
        const userId = "{{Auth::id()}}";
    </script>

    @stack('scripts')
    @vite(['resources/js/app.js'])


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>