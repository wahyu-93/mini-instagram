@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ '@' . auth()->user()->username }}</div>

                <div class="card-body">
                    <h3>FEED @isset($querySearch) "{{ $querySearch }}" @endisset</h3>
                    @forelse ($posts as $post)
                        <div>
                            <img src="{{ asset('images/post/' . $post->image) }}" width="300px" height="200px" alt="{{ $post->caption }}" ondblclick="like({{ $post->id }})">
                            <p>
                                <button class="btn btn-primary btn-sm mt-2" onclick="like({{ $post->id }})" id="btn-like-{{ $post->id }}">
                                    {{ ($post->is_like() ? 'Unlike' : 'Like') }}
                                </button>
                            </p>
                            <p>
                                <a href="{{ route('user.show', [$post->user->username]) }}">{{ '@' . $post->user->username }}</a>
                                <span>{{ $post->created_at }}</span>                                
                            </p>

                            <p >
                                {{ $post->caption }}
                            </p>
                        </div>
                    @empty
                        <p>Tidak Ditemukan...</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function like(post_id)
    {
        const btnLike = document.getElementById('btn-like-' + post_id) 

        fetch('/like/' + post_id)
        .then(response => response.json())
        .then(data => {
            console.log(data.message)

            let btnText = (data.message == 'like') ? 'Unlike' : 'Like'
            let classText  = (data.message == 'like') ? 'btn btn-danger btn-sm mt-2' : 'btn btn-primary btn-sm mt-2' 
            btnLike.innerText = btnText
            btnLike.className = classText
        });
    }
</script>
@endsection
