<div class="sidebar student">
    <div class="profile-wrap mb-2" onclick="window.location.href ='{{ route('student_profile') }}'">
        <div class="cover-image position-relative" style="background-image: url('{{ asset('images/10085211.jpg') }}')">
            @php
                $image = auth()->guard('student')->user()->profile_picture;
                $self_user = auth()->guard('student')->user();
            @endphp
            <img src="{{ asset('uploads/profiles/' . $image) }}" alt="profile" class="profile">
        </div>
        <div class="text-wrap p-3 pt-0">
            <div class="name">{{ $self_user->first_name . ' ' . $self_user->last_name }}</div>
            <div class="email">{{ $self_user->email }}</div>
            <div class="grade">Grade {{ $self_user->grade }}</div>
        </div>
    </div>
    <div class="menu-wrap">
        <a href="{{ route('student_dashboard') }}" class="menu-link">
            <div class="sp active"></div>
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('student_learning_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-mortarboard"></i>
            <span>Learning Area</span>
        </a>
        <a href="{{ route('student_quiz_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-patch-question"></i>
            <span>Quizes</span>
        </a>

        <a href="{{ route('student_payment_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-cash"></i>
            <span>Payments</span>
        </a>
        <a href="{{ route('student_calender_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-calendar2-week"></i>
            <span>Calendar</span>
        </a>
        <a href="{{ route('student_message_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-chat-dots"></i>
            <span>Message</span>
        </a>
    </div>
</div>
