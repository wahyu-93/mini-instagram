@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('post.update', [$post]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group text-center">
                            <img src="{{ asset('images/post/' . $post->image) }}" width="450px" height="450px">
                        </div>

                        <div class="form-group mb-2">
                            <label for="caption">Caption Kamu</label>
                            <textarea name="caption" id="caption" class="form-control">{{ $post->caption }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Update Caption!
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
