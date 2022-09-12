<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/welcome-page.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />

        <title>Grāmatu Plaukts</title>

        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
        @stack('styles')
    </head>
    <body>
        <div class="big-logo">
            <img src="{{ asset('png/logo.png') }}" width="50px">
            <p>Grāmatu plaukts<span class="sup">TM</span></p>
        </div>
        @if (Route::has('login'))
            <div class="kiaa">
                @auth
                    <a href="{{ url('/profile/'.auth()->user()->username) }}" class="go-to-profile">Go to your profile</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </body>
</html>