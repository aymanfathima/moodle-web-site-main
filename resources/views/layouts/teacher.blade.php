<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- meta data --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    {{-- bootstrap font --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- cropper css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css"
        integrity="sha512-+VDbDxc9zesADd49pfvz7CgsOl2xREI/7gnzcdyA9XjuTxLXrdpuz21VVIqc5HPfZji2CypSbxx1lgD7BgBK5g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- cropper js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js"
        integrity="sha512-ZK6m9vADamSl5fxBPtXw6ho6A4TuX89HUbcfvxa2v2NYNT/7l8yFGJ3JlXyMN4hlNbz0il4k6DvqbIW5CCwqkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- jquery --}}
    <script src="{{ asset('js/jquery.js') }}"></script>

    {{-- compiled resources --}}
    @vite(['resources/js/app.js'])

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- external styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body id="body" class="@yield('class')">
    <div id="app">

        {{-- navbar --}}
        @include('partials.navbar_guest')

        <div class="container-fluid skip-navbar">
            <div class="row g-3">
                <div class="col-12 col-lg-4 col-xl-3 pt-3">
                    {{-- sidebar --}}
                    @include('partials.sidebar_teacher')
                </div>
                <div class="col-12 col-lg-8 col-xl-9 pt-3">
                    {{-- content --}}
                    @yield('content')
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
</body>

</html>
