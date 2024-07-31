@extends('layouts.admin')
@section('class', 'dashboard admin')
@section('content')

    <div class="menu-title mb-4">Payment Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('admin_dashboard') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Grade</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>For Month</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->student_id }}</td>
                        <td>{{ $payment->student->first_name . ' ' . $payment->student->last_name }}</td>
                        <td>Grade {{ $payment->student->grade }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>{{ $payment->for_month }}</td>

                        <td class="actions">
                            <a href="{{ route('home', ['id' => $payment->id]) }}" class="view">VIEW</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>



@endsection
