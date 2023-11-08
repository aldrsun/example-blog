<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Home - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#languageForm').on('change', function() {
                $('#languageForm').submit();
            });

            $( ".heart-filled-image" ).click(function() {
                $(this).closest(".like-form").submit();
            });
            $( ".heart-outline-image-unauth" ).click(function() {
                $( ".like-form-unauth" ).submit();
            });
            $( ".heart-outline-image" ).click(function() {
                $(this).closest(".like-form").submit();
            });

        });
    </script>
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#!">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    @yield('notifications')
                </li>
                <li class="nav-item">
                    <form class="nav-link" id="languageForm" action="{{route('language')}}" method="POST">
                        @csrf
                        <select name="language">
                            <option value="">{{ app()->getLocale() }}</option>
                            <option value="en">en</option>
                            <option value="tr">tr</option>
                        </select>
                    </form>
                </li>
                <li class="nav-item"><a class="nav-link" href="/example-blog/public/">{{ __('home')}}</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">{{ __('about')}}</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ url('/dashboard') }}">{{ __('dashboard') }}</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('profile.edit') }}">Profile</a></li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li class="nav-item">
                            <button class="nav-link" type="submit" style="color: white; background-color: #2c3034">{{ __('logout') }}</button></li>
                    </form>
                @else
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('login') }}"> {{ __('login') }}</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('register') }}"> {{ __('register') }}</a></li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    @yield('content')
</div>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('js/scripts.js')}}"></script>
</body>
</html>
