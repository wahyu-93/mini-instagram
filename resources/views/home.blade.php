@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ '@' . auth()->user()->username }}</div>

                <div class="card-body">
                    <h3>FEED</h3>
                    @foreach ($posts as $post)
                        <div>
                            <img src="{{ asset('images/post/' . $post->image) }}" width="300px" height="200px" alt="{{ $post->caption }}">
                            <p>
                                <a href="{{ route('user.show', [$post->user->username]) }}">{{ '@' . $post->user->username }}</a>
                                <span>{{ $post->created_at }}</span>                                
                            </p>

                            <p >
                                {{ $post->caption }}
                            </p>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
