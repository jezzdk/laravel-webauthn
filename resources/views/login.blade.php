<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

        @vite(['resources/js/app.js', 'resources/js/vendor/webauthn/webauthn.js'])
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @include('navbar')

            <div>
                <h2 class="text-3xl text-red-500 mb-4 text-center">Log in</h2>
                <div class="max-w-6xl mx-auto sm:p-6 lg:p-8 rounded-lg shadow-lg bg-white">

                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email">E-mail</label>

                            <input id="email" class="block mt-1 w-full border-gray-400 border rounded p-2" type="email" name="email" value="{{ old('email') }}" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('webauthn.lost.form') }}">
                                    {{ __('Lost your device?') }}
                                </a>
                            @endif

                            <button type="submit" class="ml-3 bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Login users -->
        <script>
            const login = event => {
                event.preventDefault()

                new WebAuthn().login({
                    email: document.getElementById('email').value,
                }).then(response => {
                    //alert('Authentication successful!');
                    top.location.href = '/home';
                })
                .catch(error => {
                    alert('Something went wrong, try again!');
                    console.log(error);
                })
            }

            document.getElementById('login-form').addEventListener('submit', login)
        </script>
    </body>
</html>
