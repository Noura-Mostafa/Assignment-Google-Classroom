<!doctype html>
<html dir="{{App::isLocale('ar')? 'rtl' : 'ltr'}}" lang="{{App::currentLocale()}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('imgs/Google_Classroom_Logo.svg.png')}}" />
    @if (App::currentLocale() == 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    @endif
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://kit.fontawesome.com/6cb271fdf5.js" crossorigin="anonymous"></script>
</head>

@stack('style')


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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-plus"></i>
                            </a>
                            <ul class="dropdown-menu p-2 fs-6">
                                <li><a class="dropdown-item" href="{{route('classrooms.create')}}">{{__('Create Class')}}</a></li>
                                <li><a class="dropdown-item" href="{{route('classrooms.trashed')}}">{{__('Trashed')}}</a></li>
                                <li><a class="dropdown-item" href="{{route('profiles.create')}}">{{__('Profile')}}</a></li>
                            </ul>
                        </li>

                        <x-user-notification-menu />

                        <li class="nav-item dropdown fs-6">
                            <a class="nav-link fs-6 dropdown-toggle text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-globe"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li> <a href="{{ route('change.language', ['locale' => 'en']) }}" class="nav-link">English</a>
                                </li>
                                <li> <a href="{{ route('change.language', ['locale' => 'ar']) }}" class="nav-link">Arabic</a>
                                </li>
                            </ul>

                        </li>


                        <li class="nav-item dropdown fs-6">
                            <a class="nav-link fs-6 dropdown-toggle text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name={{Auth::user()?->name}}&size=30" class="rounded-circle" alt="">
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item  d-flex align-items-center">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link class="text-dark text-decoration-none" :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </li>
                            </ul>

                        </li>

                    </ul>

                </div>

            </div>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        var classroomId;
        const userId = "{{Auth::id()}}";
    </script>

    @stack('scripts')
    @vite(['resources/js/app.js'])

    <script type="module">
        // Import the functions you need from the SDKs you need
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js";
        import {
            getMessaging,
            getToken
        } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-messaging.js";

        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBDPHluxzm55GxCNgKpcrjWNQzKR9FgPwM",
            authDomain: "classroom-clone-bfeb9.firebaseapp.com",
            projectId: "classroom-clone-bfeb9",
            storageBucket: "classroom-clone-bfeb9.appspot.com",
            messagingSenderId: "612140338083",
            appId: "1:612140338083:web:c8d2784ced04327f8ea816"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);

        // Initialize Firebase Cloud Messaging and get a reference to the service
        const messaging = getMessaging();

        getToken(messaging, {
            vapidKey: "BPQQrf5-_fy6asZSlEN2aUwFTeMm9LcJGyHwXV--gTuQiFDJwkazOGWA1RJJ7Ba2rsE_cJVPE75rB6aa17mjfjM"
        }).then((currentToken) => {
            console.log(currentToken);
            if (currentToken) {
                $.post('/api/v1/devices', {
                    _token: "{{ csrf_token() }}",
                    token: currentToken
                }, () => {})
            } else {
                // Show permission request UI
                console.log('No registration token available. Request permission to generate one.');
                // ...
            }
        }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
            // ...
        });;
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>