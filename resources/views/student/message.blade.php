@extends('layouts.student')
@section('class', 'dashboard student')
@section('content')

    <div class="menu-title mb-4">Message Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('student_dashboard') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Send New Message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Search By Name" oninput="search_users()"
                        id="search_user">
                    <div class="users">

                    </div>
                </div>

                <script>
                    function search_users() {
                        let search = document.querySelector('.modal-body input').value;
                        var userWrap = document.querySelector('.modal-body .users');
                        if (search.length < 3) {
                            userWrap.innerHTML = '';
                            return;
                        }
                        let xhr = new XMLHttpRequest();
                        xhr.open('POST', '/get_all_users', true);
                        xhr.setRequestHeader('Content-Type', 'application/json');
                        let data = {
                            search: search
                        };
                        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                        xhr.send(JSON.stringify(data));
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                console.log(xhr.responseText);
                                var data = JSON.parse(xhr.responseText);

                                userWrap.innerHTML = '';
                                data.forEach(user => {
                                    userWrap.innerHTML += `<div class="message-user-card" data-bs-dismiss="modal" data-id="${user.id}" data-role="${user.role}">
                                <div class="image">
                                    <img src="${user.image}" alt="">
                                </div>
                                <div class="text-wrap">
                                    <div class="name">${user.name}</div>
                                    <div class="email"><span>${user.role} : </span>${user.email}</div>
                                </div>
                            </div>`;
                                });
                            }
                        }
                    }
                </script>
            </div>
        </div>
    </div>


    <div class="message-user-wrap">
        <div class="users">
            <div type="button" class="new-chat" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                onclick="document.getElementById('search_user').value = ''"><i class="bi bi-caret-left-fill"></i> New
                Message</div>
            @php
                $counter = 0;
            @endphp
            @foreach ($userList as $user)
                <div class="message-user-card" data-id="{{ $user[$counter]->id }}" data-role="{{ $user[$counter]->role }}">

                    <div class="image">
                        @php
                            $image =
                                $user[$counter]->profile_picture == 'user.png'
                                    ? 'images/user.png'
                                    : 'uploads/profiles/' . $user[$counter]->profile_picture;
                        @endphp
                        <img src="{{ asset($image) }}" alt="">
                    </div>
                    <div class="text-wrap">
                        <div class="name">{{ $user[$counter]->first_name . ' ' . $user[$counter]->last_name }}</div>
                        <div class="email"><span>{{ $user[$counter]->role }} : </span>{{ $user[$counter]->email }}</div>
                    </div>
                </div>

                @php

                @endphp
            @endforeach
        </div>
        <div class="chats">
            <div class="chats-wrap">

            </div>
            <div class="send-wrap">
                <input type="hidden" class="reciever-role">
                <input type="hidden" class="reciever-id">
                <input type="text" class="form-control send-message" placeholder="Type a message">
                <button class="btn-primary send-btn">Send</button>
            </div>
        </div>



    </div>

    <script>
        let selected_user_image = null;
        $('.chats').hide();
        let self_image = "{{ asset('uploads/profiles/' . auth()->guard('student')->user()->profile_picture) }}";
        $('.chats-wrap').scrollTop($('.chats-wrap')[0].scrollHeight);
        // send message
        $(document).ready(function() {
            $('.send-btn').click(function() {
                let message = $('.send-message').val();
                if (message == '') {
                    return;
                }
                $('.send-message').val('');
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '/send_message', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                let data = {
                    message: message,
                    receiver_id: $('.reciever-id').val(),
                    receiver_role: $('.reciever-role').val(),
                    sender_id: "{{ auth()->guard('student')->user()->id }}",
                    sender_role: "Student",
                };
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                xhr.send(JSON.stringify(data));
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(xhr.responseText);

                        var data = JSON.parse(xhr.responseText);
                        var messageWrap = document.querySelector('.message-user-wrap .chats-wrap');
                        messageWrap.innerHTML += `
            <div class="message sent">
                <div class="img">
                    <img src="${data.type == 'sent' ? self_image : selected_user_image}" alt="">
                </div>
                <div class="msg">
                    ${data.message}
                </div>
            </div>
            `;
                    }
                }
            });
        });

        $(document).ready(function() {
            $('.modal-body').on('click', '.message-user-card', function() {
                let id = $(this).data('id');
                let role = $(this).data('role');
                selected_user_image = $(this).find('img').attr('src');
                $('.chats').show();
                $('.reciever-role').val(role);
                $('.reciever-id').val(id);

                let xhr = new XMLHttpRequest();
                xhr.open('POST', '/get_user_messages', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                let data = {
                    id: id,
                    srole: role,
                    urole: 'Student'
                };
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                xhr.send(JSON.stringify(data));
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(xhr.responseText);
                        var data = JSON.parse(xhr.responseText);
                        var messageWrap = document.querySelector('.message-user-wrap .chats-wrap');
                        messageWrap.innerHTML = '';
                        data.forEach(message => {
                            console.log(message);
                            messageWrap.innerHTML += `
            <div class="message ${message.type}">
                <div class="img">
                    <img src="${message.type == 'sent' ? self_image : selected_user_image}" alt="">
                </div>
                <div class="msg">
                    ${message.message}
                </div>
            </div>
            `;
                        });
                    }
                }
            });
        });



        $(document).ready(function() {
            $('.message-user-wrap').on('click', '.message-user-card', function() {
                let id = $(this).data('id');
                let role = $(this).data('role');
                selected_user_image = $(this).find('img').attr('src');
                $('.chats').show();
                $('.reciever-role').val(role);
                $('.reciever-id').val(id);
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '/get_user_messages', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                let data = {
                    id: id,
                    srole: role,
                    urole: 'Student'
                };
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                xhr.send(JSON.stringify(data));
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(xhr.responseText);
                        var data = JSON.parse(xhr.responseText);
                        var messageWrap = document.querySelector('.message-user-wrap .chats-wrap');
                        messageWrap.innerHTML = '';
                        data.forEach(message => {
                            console.log(message);
                            messageWrap.innerHTML += `
            <div class="message ${message.type}">
                <div class="img">
                    <img src="${message.type == 'sent' ? self_image : selected_user_image}" alt="">
                </div>
                <div class="msg">
                    ${message.message}
                </div>
            </div>
            `;
                        });
                    }
                }
            });
        });
    </script>

@endsection
