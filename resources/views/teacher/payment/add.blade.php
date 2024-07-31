@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="menu-title mb-4">Payment Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_payment_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="form-wrap">
        <form action="{{ route('teacher_payment_store') }}" method="POST">
            @csrf
            <div class="row gy-2 gx-3">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label class="form-label">Student ID</label>
                        <input type="text" class="form-control" value="{{ $student->id }}" disabled readonly>
                        <input type="hidden" class="form-control" id="student_id" name="student_id"
                            value="{{ $student->id }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label class="form-label">Student Name</label>
                        <input type="text" class="form-control"
                            value="{{ $student->first_name . ' ' . $student->last_name }}" disabled readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label class="form-label">Last Payed Date</label>
                        <input type="text" class="form-control"
                            value="{{ $student->payments->first()->payment_date ?? '-' }}" disabled readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label class="form-label">Last Payed Month</label>
                        <input type="text" class="form-control"
                            value="{{ $student->payments->first()->for_month ?? '-' }}" disabled readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label class="form-label">Next Paying Month</label>
                        <input type="text" class="form-control" value="{{ $nextMonth }}" disabled readonly>
                        <input type="hidden" class="form-control" id="for_month" name="for_month"
                            value="{{ $nextMonth }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount"
                            value="{{ old('amount') }}">
                    </div>
                    @error('amount')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i> Save
                            Payment</button>
                    </div>
                </div>
            </div>
        </form>

    @endsection
