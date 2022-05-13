@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post Foto</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <x-uploadimage name="image"></x-uploadimage>
                        </div>

                        <div class="row mb-3">
                            <label for="caption" class="col-md-4 col-form-label text-md-end">Caption Kamu</label>
                            <div class="col-md-6">
                                <textarea name="caption" id="caption" class="form-control"></textarea>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Post!
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
