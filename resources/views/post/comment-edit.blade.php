@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Komentar</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('comment.update', [$comment]) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="body" class="col-md-4 col-form-label text-md-end">Komentar Kamu</label>
                            <div class="col-md-6">
                                <textarea name="body" id="body" class="form-control">{{ $comment->body }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Komentar
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
