<div class="card card-primary mb-3">
    <div class="card-body">
        <img src="{{ asset('images/post/' . $post->image) }}" width="100%" height="512px" alt="{{ $post->caption }}" ondblclick="like({{ $post->id }})" class="mb-3">
        
        <div class="d-flex justify-content-between">
            <p id="post-count-{{ $post->id }}" class="mb-0">{{ $post->likes_count }} <span>Menyukai</span></p>
            <p id="post-count-{{ $post->id }}" class="mb-0 float-end"> 0 <span>Komentar</span></p>
        </div>
        
        <hr class="mb-0 mt-0">
        
        
        <p class="mb-0">
            <button class="btn {{ ($post->is_like() ? 'btn-danger' : 'btn-primary') }} btn-sm mt-2" onclick="like({{ $post->id }})" id="post-like-{{ $post->id }}">
                {{ ($post->is_like() ? 'Unlike' : 'Like') }}
            </button>
    
            <a href="{{ route('post.show', [$post->id]) }}" class="btn btn-primary btn-sm mt-2">Komentar</a>
        </p>
        <p class="mb-0">
            <a href="{{ route('user.show', [$post->user->username]) }}">{{ '@' . $post->user->username }}</a>
            <span>{{ $post->created_at->diffForhumans() }}</span>                                
        </p>
    
        <p class="caption mb-0">
            {{ $post->caption }}    
        </p>
    </div>
</div>