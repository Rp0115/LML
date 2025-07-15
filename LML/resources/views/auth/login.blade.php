<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href='{{ asset("css/loginstyle.css") }}'/>
</head>
<body class="LoginBody">

    <div class="login-container">
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

            <div class="newAccount">
                <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="newAccountText">
                    {{ __('Create New Account') }}
                </x-nav-link>
            </div>

            <div class="forgotPassword">
                <x-nav-link :href="route('password.request')" :active="request()->routeIs('password.request')" class="forgotPasswordText">
                    {{ __('Forgot Your Password?') }}
                </x-nav-link>
            </div>
        </form>
    </div>

</body>
</html>