<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/auth.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron login page"/>
    <title>zentron - login</title>
</head>

<body>

@include('components.header')

<main class="register-main">
    <section class="register-shell" aria-label="Log-in options">
        <section class="register-social" aria-label="Social login">
            <h2>You can also log-in with these:</h2>

            <button class="register-btn" type="button">
                Log in with Google
            </button>
            <button class="register-btn" type="button">
                Log in with Apple
            </button>
            <button class="register-btn" type="button">
                Log in with Facebook
            </button>

            <p class="register-help">
                Don’t have an account? Create one
                <a href="/register">here</a>
            </p>
        </section>

        <div class="register-divider" aria-hidden="true"></div>

        <section class="register-form-wrap" aria-label="Login form">
            <h2>Welcome back! Log in to your account.</h2>

            <form class="register-form" action="/login" method="post">
                @csrf
                <label for="login-email">E-mail:</label>
                <input
                    id="login-email"
                    name="email"
                    type="email"
                    placeholder="jankohrasko67@yahoo.com"
                    autocomplete="email"
                />

                <label for="login-password">Password:</label>
                <div class="password-row">
                    <input
                        id="login-password"
                        name="password"
                        type="password"
                        placeholder="********"
                        autocomplete="current-password"
                    />
                    <button class="forgot-btn" type="button">
                        Forgot password?
                    </button>
                </div>

                <button class="register-btn" type="submit">
                    Login
                </button>
            </form>
        </section>
    </section>
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
