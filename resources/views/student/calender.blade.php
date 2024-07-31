@extends('layouts.student')
@section('class', 'dashboard student')
@section('content')

    <div class="menu-title mb-4">Profile Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('student_dashboard') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <style>
        .calendar {
            font-family: Arial, sans-serif;
            background: #ffffff68;
            backdrop-filter: blur(6px);
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
        }

        .month-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .day {
            text-align: center;
            padding: 12px;
            background-color: #ffffffce;
            box-shadow: #00000052 0px 0px 5px;
        }

        .quiz-deadline {
            background-color: #e19d9d;
        }

        .other-month {
            color: #ccc;
        }
    </style>
    <div class="calender-wrap">
        <div class="calendar">
            <div class="month-header">
                <button class="prev-month" onclick="changeMonth(-1)">&lt;</button>
                <h2>{{ $monthName }}</h2>
                <button class="next-month" onclick="changeMonth(1)">&gt;</button>
            </div>
            <div class="days">
                <div class="day">Sun</div>
                <div class="day">Mon</div>
                <div class="day">Tue</div>
                <div class="day">Wed</div>
                <div class="day">Thu</div>
                <div class="day">Fri</div>
                <div class="day">Sat</div>
                @foreach ($calendar as $week)
                    @foreach ($week as $day)
                        <div
                            class="day{{ $day['currentMonth'] ? '' : ' other-month' }}{{ $day['qdeadline'] ? ' quiz-deadline' : '' }}">

                            @if ($day['qdeadline'])
                                <a href="{{ route('student_quiz_index', ['mark' => $day['quiz']['id']]) }}">
                                    {{ $day['day'] }}
                                </a>
                            @else
                                {{ $day['day'] }}
                            @endif
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function changeMonth(delta) {
            var currentMonth = parseInt('{{ $month }}');
            var currentYear = parseInt('{{ $year }}');
            currentMonth += delta;

            if (currentMonth < 1) {
                currentMonth = 12;
                currentYear--;
            } else if (currentMonth > 12) {
                currentMonth = 1;
                currentYear++;
            }

            window.location.href = '?month=' + currentMonth + '&year=' + currentYear;
        }
    </script>
@endsection
