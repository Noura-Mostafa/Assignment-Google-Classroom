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
        <nav class="navbar navbar-expand-md">
            <div class="container">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="navbar-brand text-secondary fs-4" href="{{route('classrooms.index')}}">Google <span class="text-success">Classroom</span></a>
                    </li>
                </ul>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">

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
                            <a class="nav-link" href="{{route('classrooms.chat' , $classroom->id)}}">{{__('Chat')}}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">{{__('Grade')}}</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <x-user-notification-menu />
                        <li class="nav-item">
                            <img src="https://ui-avatars.com/api/?name={{Auth::user()?->name}}&size=35" class="rounded-circle me-2 mt-1" alt="">
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


    </header>

    <main class="bg-white">
        @yield('content')
    </main>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        var classroomId;
        const userId = "{{Auth::id()}}";
    </script>

    @stack('scripts')
    @vite(['resources/js/app.js' , 'resources/js/fcm.js'])


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>