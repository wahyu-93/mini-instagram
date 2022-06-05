@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Edit Post</div>

                <div class="card-body">
                    <x-post :post="$post"></x-post>
                    <hr>

                    <form method="POST" action="{{ route('comment.store', [$post->id]) }}">
                        @csrf

                        <div class="form-group">
                            <label for="body" >Komentar Kamu ...</label>
                            <textarea name="body" id="body" class="form-control"></textarea>
                        </div>

                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">
                                Post Komentar!
                            </button>
                        </div>
                    </form>
                    <hr>
                    
                    @foreach ($comments as $comment)
                        <div class="card card.primary mb-2">
                            <div class="card-body">
                                <p class="mb-0">
                                    <a href="{{ route('user.show', [$comment->user->username]) }}" style="text-decoration: none">{{ '@'.$comment->user->username }}</a>
                                </p>

                                <div class="bg-light p-2 rounded-pill">
                                    {{ $comment->body }} 
                                </div>

                                <span id="comment-count-{{ $comment->id }}">{{ $comment->likes_count }}</span>
                                <a onclick="like({{ $comment->id }}, 'comment')" id="comment-like-{{ $comment->id }}" style="cursor: pointer">
                                    {{ ($comment->is_like() ? 'Unlike' : 'Like') }}
                                </a>
        
                                @if(Auth::user()->id == $comment->user_id)
                                    <a href="{{ route('comment.edit', [$comment->id]) }}" style="text-decoration: none">
                                        Edit
                                    </a>
                                
                                    <a href="{{ route('comment.delete', [$comment->id]) }}" style="text-decoration: none">
                                        Hapus
                                    </a>
                                @endif                                
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/feed.js') }}"></script>
@endsection
