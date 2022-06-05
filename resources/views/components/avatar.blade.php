@php
    $avatar_url = $user->avatar ? asset('images/avatar/'.$user->avatar) : 'https://ui-avatars.com/api/?size=128&name='. $user->username
@endphp

<img class="rounded-circle" src="{{ $avatar_url }}" alt="{{ $user->avatar }}" width="{{ $size ?? 128 }}" height="{{ $size ?? 128 }}" class="rounded-circle">