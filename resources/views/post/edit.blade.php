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

                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <img src="{{ asset('images/post/' . $post->image) }}" width="450px" height="450px">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="caption" class="col-md-4 col-form-label text-md-end">Caption Kamu</label>
                            <div class="col-md-6">
                                <textarea name="caption" id="caption" class="form-control">{{ $post->caption }}</textarea>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Caption!
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
