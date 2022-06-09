@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Notifications</div>

                <div class="card-body">
                    @foreach ($notifs as $notif)
                        <li>
                            <a href="{{ route('post.show', $notif->post->id) }}">
                                {{ $notif->message }} ({{ $notif->created_at->diffForhumans() }})
                            </a>
                        </li>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
