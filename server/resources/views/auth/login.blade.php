<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Executive Clerk System</title>

    <link
        rel="stylesheet"
        href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"
    >

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            background: #f4f6f9;
        }

        .login-page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 950px;
            display: flex;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
        }

        /* LEFT SIDE */

        .login-brand {
            width: 50%;
            background: #007bff;
            color: #fff;
            padding: 60px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-icon {
            font-size: 70px;
            margin-bottom: 25px;
        }

        .login-brand h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .login-brand p {
            font-size: 16px;
            line-height: 1.7;
            opacity: 0.95;
        }

        .system-features {
            margin-top: 25px;
            padding: 0;
            list-style: none;
        }

        .system-features li {
            margin-bottom: 12px;
            font-size: 14px;
        }

        .system-features i {
            width: 25px;
        }

        /* RIGHT SIDE */

        .login-form-container {
            width: 50%;
            padding: 50px 45px;
        }

        .login-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .login-subtitle {
            color: #6c757d;
            margin-bottom: 30px;
        }

        .form-control {
            height: 45px;
        }

        .login-button {
            height: 45px;
            width: 100%;
            font-weight: 600;
        }

        .login-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 13px;
            color: #6c757d;
        }

        @media (max-width: 768px) {

            .login-container {
                flex-direction: column;
            }

            .login-brand,
            .login-form-container {
                width: 100%;
            }

            .login-brand {
                padding: 35px 30px;
                text-align: center;
            }

            .system-features {
                display: none;
            }

            .login-form-container {
                padding: 35px 30px;
            }
        }
    </style>
</head>

<body>

<div class="login-page-wrapper">

    <div class="login-container">

        {{-- LEFT SIDE --}}
        <div class="login-brand">

            <div class="brand-icon">
                <i class="fas fa-file-signature"></i>
            </div>

            <h1>
                Executive Clerk System
            </h1>

            <p>
                Document Automation and Records Management System
            </p>

            <ul class="system-features">

                <li>
                    <i class="fas fa-check-circle"></i>
                    Document Receiving
                </li>

                <li>
                    <i class="fas fa-check-circle"></i>
                    Document Tracking
                </li>

                <li>
                    <i class="fas fa-check-circle"></i>
                    Document Status Management
                </li>

                <li>
                    <i class="fas fa-check-circle"></i>
                    Records Management
                </li>

                <li>
                    <i class="fas fa-check-circle"></i>
                    Reports and Statistics
                </li>

            </ul>

        </div>


        {{-- RIGHT SIDE --}}
        <div class="login-form-container">

            <div class="login-title">
                Welcome Back
            </div>

            <div class="login-subtitle">
                Sign in to access the system.
            </div>


            {{-- Session Status --}}
            @if (session('status'))

                <div class="alert alert-success">
                    {{ session('status') }}
                </div>

            @endif


            {{-- Validation Errors --}}
            @if ($errors->any())

                <div class="alert alert-danger">

                    <i class="fas fa-exclamation-circle"></i>

                    {{ $errors->first() }}

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('login') }}"
            >

                @csrf


                {{-- Email --}}
                <div class="form-group">

                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email Address
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        autofocus
                        autocomplete="username"
                    >

                </div>


                {{-- Password --}}
                <div class="form-group">

                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password"
                    >

                </div>


                {{-- Remember Me --}}
                <div class="form-group">

                    <div class="custom-control custom-checkbox">

                        <input
                            type="checkbox"
                            class="custom-control-input"
                            id="remember_me"
                            name="remember"
                        >

                        <label
                            class="custom-control-label"
                            for="remember_me"
                        >
                            Remember me
                        </label>

                    </div>

                </div>


                {{-- Login --}}
                <button
                    type="submit"
                    class="btn btn-primary login-button"
                >

                    <i class="fas fa-sign-in-alt"></i>

                    Login

                </button>


                {{-- Forgot Password --}}
                @if (Route::has('password.request'))

                    <div class="text-center mt-3">

                        <a href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>

                    </div>

                @endif

            </form>


            <div class="login-footer">

                <i class="fas fa-shield-alt"></i>

                Authorized personnel only

                <br>

                Executive Clerk Office

            </div>

        </div>

    </div>

</div>

</body>

</html>
