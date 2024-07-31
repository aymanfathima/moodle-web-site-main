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

    {{-- cropper js --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css"
        integrity="sha512-+VDbDxc9zesADd49pfvz7CgsOl2xREI/7gnzcdyA9XjuTxLXrdpuz21VVIqc5HPfZji2CypSbxx1lgD7BgBK5g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js"
        integrity="sha512-ZK6m9vADamSl5fxBPtXw6ho6A4TuX89HUbcfvxa2v2NYNT/7l8yFGJ3JlXyMN4hlNbz0il4k6DvqbIW5CCwqkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- compiled resources --}}
    @vite(['resources/js/app.js'])

    {{-- external styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body id="body" class="@yield('class')">
    <div id="app">
        <style>
            .navbar {
                background-color: var(--w);
            }

            .navbar .nav-item a {
                color: var(--blue-1);
            }
        </style>
        {{-- navbar --}}
        @include('partials.navbar_guest')

        <div class="container skip-navbar mt-3">
            <div class="row g-5 justify-content-center">
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="menu-card">
                        <img src="{{ asset('images/1.png') }}" alt="">
                        <div class="text">
                            <div class="title">Learning Area</div>
                            <div class="description">Welcome! You can access all your lessons and learning
                                materials right here.
                            </div>
                            <a href="{{ route('student_learning_index') }}">Start Learning</a>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="menu-card">
                        <img src="{{ asset('images/2.png') }}" alt="">
                        <div class="text">
                            <div class="title">Quziess</div>
                            <div class="description">You can view and attempt quizzes here. And also can view
                                results.</div>
                            <a href="{{ route('student_quiz_index') }}">View Quizess</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="menu-card">
                        <img src="{{ asset('images/3.png') }}" alt="">
                        <div class="text">
                            <div class="title">Payments</div>
                            <div class="description">Stay informed about your payment history with easy access
                                to all your transactions.
                            </div>
                            <a href="{{ route('student_payment_index') }}">View Payments</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="menu-card">
                        <img src="{{ asset('images/4.png') }}" alt="">
                        <div class="text">
                            <div class="title">Calendar</div>
                            <div class="description">Stay updated on quiz deadlines to ensure you never miss a
                                thing. Access your calendar.
                            </div>
                            <a href="{{ route('student_calender_index') }}">View Calendar</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="menu-card">
                        <img src="{{ asset('images/5.png') }}" alt="">
                        <div class="text">
                            <div class="title">Messages</div>
                            <div class="description">Message your teachers and classmates directly from here.
                            </div>
                            <a href="{{ route('student_message_index') }}">View Messages</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.footer')
    </div>
</body>

</html>
