@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ '@' . $user->username }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center">
                        <p>
                            <x-avatar :user="$user"></x-avatar>
                        </p>
                        
                        <h5>{{ $user->fullname }}</h5>
                        <p>{{ $user->bio }}</p>
                        
                        <div class="mb-4">
                            @if($user->id == Auth()->user()->id)    
                                <a href="{{ route('post.create') }}" class="btn btn-primary">Upload</a>
                            @endif
        
                            @if($user->id == Auth()->user()->id)
                                <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">Update Profile</a>                        
                            @else
                                <button class="{{ Auth::user()->following->contains($user->id) ? 'btn btn-danger' : 'btn btn-primary' }}" onclick="follow({{ $user->id }}, this)">
                                    {{ Auth::user()->following->contains($user->id) ? 'Unfollow' : 'Follow' }}
                                </button> 
                            @endif                        
                        </div>
                    </div>
                    <hr>

                    <h3>FEED</h3>
                    @foreach ($user->posts as $post)
                        <div class="card card-primary mb-3">
                            <div class="card-body">
                                <a href="{{ route('post.show', $post) }}">
                                    <img src="{{ asset('images/post/' . $post->image) }}" width="100%" height="512px" alt="{{ $post->caption }}" class="mb-3">
                                </a>
                               
                                @if($user->id === Auth()->user()->id)
                                    <a href="{{ route('post.edit', [$post->id]) }}" style="text-decoration: none;" class="btn btn-danger btn-sm">Edit Post</a>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        function follow(user_id, el)
        {
            fetch('/follow/' + user_id)
                .then(response => response.json())
                .then(data => {
                    console.log(data.message)
                    let buttonText = (data.message == 'FOLLOW') ? 'Unfollow' : 'Follow';
                    let classText = data.message == 'FOLLOW' ? 'btn btn-danger' : 'btn btn-primary';
                    
                    el.innerText = buttonText;
                    el.className = classText;
                })
        }
    </script>
@endsection
