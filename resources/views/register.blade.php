<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/auth.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron register page"/>
    <title>zentron - register</title>
</head>

<body>
@include('components.header')

<main class="register-main">
    <section class="register-shell" aria-label="Sign-up options">
        <section class="register-social" aria-label="Social sign-up">
            <h2>You can also sign-up with these</h2>

            <button class="register-btn" type="button">
                Sign up with Google
            </button>
            <button class="register-btn" type="button">
                Sign up with Apple
            </button>
            <button class="register-btn" type="button">
                Sign up with Facebook
            </button>

            <p class="register-help">
                Already have an account?
                <a href="/login.html">Sign-in here</a>
            </p>
        </section>

        <div class="register-divider" aria-hidden="true"></div>

        <section
            class="register-form-wrap"
            aria-label="Create account form"
        >
            <h2>
                Create a new account! Become a part of the community!
            </h2>

            <form class="register-form" action="#" method="post">
                <label for="name">Name:</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Janko Hrasko"
                    autocomplete="name"
                />

                <label for="password">Password:</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="********"
                    autocomplete="new-password"
                />

                <label for="confirm-password">Confirm password:</label>
                <input
                    id="confirm-password"
                    name="password_confirmation"
                    type="password"
                    placeholder="********"
                    autocomplete="new-password"
                />

                <label for="email">E-mail:</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="jankohrasko67@yahoo.com"
                    autocomplete="email"
                />

                <div class="terms-block">
                    <p>
                        By joining, you agree to our terms of service
                        and acknowledge that your account data will be
                        used to personalize your store experience.
                    </p>
                    <label class="terms-check" for="accept-terms">
                        <input
                            id="accept-terms"
                            name="accept-terms"
                            type="checkbox"
                        />
                        I accept the terms and privacy policy.
                    </label>
                </div>

                <button class="register-btn" type="submit">Join</button>
            </form>
        </section>
    </section>
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
