@extends('layouts.student')
@section('class', 'dashboard student')
@section('content')

    <div class="menu-title mb-4">Payment Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('student_dashboard') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Amount</th>
                    <th>Paied Date</th>
                    <th>Payied For</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 1;
                @endphp
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $counter }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>{{ $payment->for_month }}</td>
                    </tr>
                    @php
                        $counter++;
                    @endphp
                @endforeach

            </tbody>
        </table>
    </div>



@endsection
