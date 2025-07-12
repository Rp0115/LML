<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href='{{ asset("css/loginstyle.css") }}'/>
</head>
<body class="LoginBody">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <img class="pfp" src="{{ asset('images/loginPfp.png') }}" alt="Profile Picture" />

    <h1 class="LoginName">Test User</h1>

    <form method="POST" action="{{ route('login') }}" class="Login">
        @csrf

        <div class="usernameBox" style="text-align: center;">
            <x-text-input id="email" class="loginBox" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <br>

        <div class="passwordBox">
            <x-text-input id="password" class="loginBox2"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Password"/>

            <button class="arrowBtn" type="submit"></button>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2" style="text-align: center;" />


        {{-- <div class="block mt-4 text-center">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div> --}}
    </form>
</body>
</html>