@extends('layouts.main')

@section('content')
    <div class="container text-muted">

        <div class="row mb-4">
            <div>
                <img src="{{ Storage::url($contents->profile_photo_path) }}" alt="" width="150px" class="rounded-full mx-auto">
                <h2 class="text-center mt-1">{{ $contents->name }}</h2>
            </div>
        </div>

        <div class="row p-3">
            <ul class="nav nav-tabs mb-3">
                @php
                    $user_id = $contents->id;
                @endphp

                <li class="nav-item" style="list-style: none">
                    <a href="{{ route('profile', $user_id) }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">منشوراتي</a>
                </li>

                <li class="nav-item" style="list-style: none">
                    <a href="{{ route('user_comments', $user_id) }}" class="nav-link {{ request()->routeIs('user_comments') ? 'active' : '' }}">تعليقاتي</a>
                </li>
            </ul>

            @if (request()->routeIs('user_comments'))
                @include('user.comments_section')
            @else
                @include('user.post_section')
            @endif
        </div>

    </div>
@endsection
