@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>

                <div class="card-body">
                    <x-post :post="$post"></x-post>
                    <hr>

                    <form method="POST" action="{{ route('comment.store', [$post->id]) }}">
                        @csrf
                       
                        <div class="row mb-3">
                            <label for="body" class="col-md-4 col-form-label text-md-end">Komentar Kamu ...</label>
                            <div class="col-md-6">
                                <textarea name="body" id="body" class="form-control"></textarea>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Post Komentar!
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    
                    @foreach ($post->comments as $comment)
                        <p>
                            {{ $comment->body }} - 
                            <a href="{{ route('user.show', [$comment->user->username]) }}">
                                {{ '@'.$comment->user->username }}
                            </a>
                        </p>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/feed.js') }}"></script>
@endsection
