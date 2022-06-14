@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Dashoard</div>

                <div class="card-body">
                    <h3>FEED @isset($querySearch) "{{ $querySearch }}" @endisset</h3>
                    @forelse ($posts as $post)
                        <x-post :post="$post"></x-post>
                        <input type="hidden" class="post-time" value="{{ strtotime($post->created_at) }}">
                    @empty
                        <p>Tidak Ditemukan...</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/feed.js') }}"></script>
@endsection
