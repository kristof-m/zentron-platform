<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/admin.css')
    @vite('resources/css/form.css')
    @vite('resources/css/auth.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron admin login page"/>
    <title>zentron - admin login</title>
</head>

<body class="admin-page">

@include('admin.header')

<main class="register-main">
    <section class="register-shell" aria-label="Admin sign-in">
        <section class="register-social" aria-label="Admin note">
            <h2>Administrator access</h2>
            <p class="register-help">
                This page is intended for administrators only.
            </p>
            <p class="register-help">
                Use your admin account to manage products.
            </p>
        </section>

        <div class="register-divider" aria-hidden="true"></div>

        <section
            class="register-form-wrap"
            aria-label="Admin login form"
        >
            <h2>Sign in to admin panel</h2>

            <form class="register-form" action="/login" method="post">
                <input type="hidden" name="redirect-to" value="admin-home"/>
                <label for="admin-email">E-mail</label>
                <input
                    id="admin-email"
                    name="email"
                    type="email"
                    placeholder="admin@zentron.sk"
                    autocomplete="email"
                />

                <label for="admin-password">Password</label>
                <input
                    id="admin-password"
                    name="password"
                    type="password"
                    placeholder="********"
                    autocomplete="current-password"
                />

                <label class="terms-check" for="remember-admin">
                    <input
                        id="remember-admin"
                        name="remember-admin"
                        type="checkbox"
                    />
                    Keep me signed in on this device.
                </label>

                @if ($errors->any())
                    <div class="form-errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button class="register-btn" type="submit">
                    Log in as admin
                </button>
            </form>
        </section>
    </section>
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
