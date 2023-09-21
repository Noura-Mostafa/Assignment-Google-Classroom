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

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="container">
        <main id="main" class="m-auto mt-5 shadow-lg py-5" style="width:500px;">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="text-center rounded-circle mb-2">
                    <img src="{{ asset('imgs/Google_Classroom_Logo.svg.png') }}" alt="" width="150" height="150">
                    <h3>Google Classroom</h3>
                </div>

                <!-- Email Address -->
                <div class="w-75 m-auto">
                    <label class="form-label mt-3 text-muted" for="{{ config('fortify.username') }}">username/email</label>
                    <x-form.input id="{{ config('fortify.username') }}" class="block mt-1 w-full" type="text" name="{{ config('fortify.username') }}" :value="old(config('fortify.username'))" required autofocus autocomplete="{{ config('fortify.username') }}" />
                    <x-input-error :messages="$errors->get(config('fortify.username'))" class="mt-2" />
                </div>


                <!-- Password -->
                <div class="w-75 m-auto">
                    <label class="form-label mt-3 text-muted" for="password">password</label>
                    <x-form.input name="password" id="password" type="password" :value="old('password')" required autofocus autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>


                <!-- Remember Me -->
                <div class="w-75 m-auto">
                    <label for="remember_me" class="form-label mt-3 text-muted">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span class="">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="w-75 m-auto d-flex flex-column">
                    @if (Route::has('password.request'))
                    <a class="mb-3 text-success" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                    <button type="submit" class="btn btn-success w-50 m-auto mt-4">Login</button>
                </div>

            </form>
        </main>
    </div>

    <scrip src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>