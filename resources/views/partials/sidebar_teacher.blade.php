<div class="sidebar student">
    <div class="profile-wrap mb-2" onclick="window.location.href ='{{ route('teacher_profile') }}'">
        <div class="cover-image position-relative"
            style="background-image: url('{{ asset('images/15273958_5587898.jpeg') }}')">
            @php
                $image = auth()->guard('teacher')->user()->profile_picture;
                $self_user = auth()->guard('teacher')->user();
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
        <a href="{{ route('teacher_dashboard') }}" class="menu-link">
            <div class="sp active"></div>
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('teacher_student_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-people"></i>
            <span>Manage Students</span>
        </a>
        <a href="{{ route('teacher_lesson_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-mortarboard"></i>
            <span>Manage Lessons</span>
        </a>
        <a href="{{ route('teacher_asset_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-file-earmark-zip"></i>
            <span>Manage Assets</span>
        </a>
        <a href="{{ route('teacher_payment_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-cash"></i>
            <span>Manage Payments</span>
        </a>
        <a href="{{ route('teacher_quiz_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-patch-question"></i>
            <span>Manage Quizes</span>
        </a>
        <a href="{{ route('teacher_message_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-chat-dots"></i>
            <span>Message</span>
        </a>
    </div>
</div>
