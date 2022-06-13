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

                    <div class="d-flex justify-content-around">
                        <div id="avatarProfile">
                            <p>
                                <x-avatar :user="$user"></x-avatar>
                            </p>
                        </div>

                        <div id="profileUser">
                            <div class="px-4">
                                <h5 class="mb-0">{{ $user->fullname }}</h5>
                                @if($user->id == Auth()->user()->id)    
                                    <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm">Upload</a>
                                @endif
            
                                @if($user->id == Auth()->user()->id)
                                    <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-sm">Update Profile</a>                        
                                @else
                                    <button class="{{ Auth::user()->following->contains($user->id) ? 'btn btn-danger btn-sm' : 'btn btn-primary btn-sm' }}" onclick="follow({{ $user->id }}, this)">
                                        {{ Auth::user()->following->contains($user->id) ? 'Unfollow' : 'Follow' }}
                                    </button> 
                                @endif                        
                            </div>
                            
                            <div class="d-flex">    
                                <div id="postingan" class="pt-1 px-4">
                                    <p class="mb-0">Postingan</p>
                                    <p class="text-center">0</p>
                                </div>

                                <div id="following" class="pt-1 px-4">
                                    <p class="mb-0">Follwowing</p>
                                    <p class="text-center">{{ $user->following()->count() }}</p>
                                </div>
                                
                                <div id="follower" class="pt-1 px-4">
                                    <p class="mb-0">Follower</p>
                                    <p class="text-center">{{ $user->follower()->count() }}</p>
                                </div>
                            </div>

                            <div class="px-4">
                                <p class="mb-0">{{ $user->bio }}</p>
                            </div>

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
