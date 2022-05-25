@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        <x-avatar :user="$user"></x-avatar>
                    </p>
                    <h5>{{ $user->fullname }}</h5>
                    <p>{{ $user->bio }}</p>

                    <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm">Upload</a><br>
                    <br>

                    <h3>FEED</h3>
                    @foreach ($posts as $post)
                        <li>
                            <img src="{{ asset('images/post/' . $post->image) }}" width="200px" height="200px" alt="{{ $post->caption }}">
                            <a href="{{ route('post.edit', [$post->id]) }}">Edit</a>
                        </li>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
