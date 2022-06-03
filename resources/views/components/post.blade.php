<div>
    <img src="{{ asset('images/post/' . $post->image) }}" width="300px" height="200px" alt="{{ $post->caption }}" ondblclick="like({{ $post->id }})">
    <p>
        <button class="btn {{ ($post->is_like() ? 'btn-danger' : 'btn-primary') }} btn-sm mt-2" onclick="like({{ $post->id }})" id="post-like-{{ $post->id }}">
            {{ ($post->is_like() ? 'Unlike' : 'Like') }}
        </button>

        <a href="{{ route('post.show', [$post->id]) }}" class="btn btn-primary btn-sm mt-2">Komentar</a>
    </p>
    <p>
        <a href="{{ route('user.show', [$post->user->username]) }}">{{ '@' . $post->user->username }}</a>
        <span>{{ $post->created_at }}</span>                                
    </p>

    <p class="caption">
        {{ $post->caption }}    
    </p>
</div>