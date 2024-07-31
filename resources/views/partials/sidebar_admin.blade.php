<div class="sidebar admin">
    <div class="profile-wrap mb-2" onclick="window.location.href ='{{ route('admin_profile') }}'">
        <div class="cover-image position-relative" style="background-image: url('{{ asset('images/23123.jpeg') }}')">
            @php
                $image = auth()->guard('admin')->user()->profile_picture;
                $self_user = auth()->guard('admin')->user();
            @endphp
            <img src="{{ asset('uploads/profiles/' . $image) }}" alt="profile" class="profile">
        </div>
        <div class="text-wrap p-3 pt-0">
            <div class="name">{{ $self_user->first_name . ' ' . $self_user->last_name }}</div>
            <div class="email">{{ $self_user->email }}</div>
            <div class="grade">System Admin</div>
        </div>
    </div>
    <div class="menu-wrap">
        <a href="{{ route('admin_dashboard') }}" class="menu-link active">
            <div class="sp"></div>
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin_student_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-people"></i>
            <span>Manage Students</span>
        </a>
        <a href="{{ route('admin_teacher_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-people"></i>
            <span>Manage Teachers</span>
        </a>
        <a href="{{ route('admin_quiz_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-patch-question"></i>
            <span>Manage Quizes</span>
        </a>
        <a href="{{ route('admin_payment_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-cash"></i>
            <span>Manage Payments</span>
        </a>
        <a href="{{ route('admin_notice_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-card-list"></i>
            <span>Special Notice</span>
        </a>
        <a href="{{ route('admin_message_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-chat-dots"></i>
            <span>Message</span>
        </a>
        <a href="{{ route('admin_contact_us_index') }}" class="menu-link">
            <div class="sp"></div>
            <i class="bi bi-person-lines-fill"></i>
            <span>Contact</span>
        </a>
    </div>
</div>
