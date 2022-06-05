<div class="card card-primary mb-3">
    <div class="card-body">
        <div class="d-flex">
            <div class="me-2">
                <x-avatar :user="$post->user" size="40"></x-avatar>
            </div>

            <div>
                <a href="{{ route('user.show', [$post->user->username]) }}" style="text-decoration: none">{{ '@' . $post->user->username }}</a>
                <p class="text-muted mb-0">{{ $post->created_at->diffForhumans() }}</p>                                
            </div>
        </div>

        <img src="{{ asset('images/post/' . $post->image) }}" width="100%" height="512px" alt="{{ $post->caption }}" ondblclick="like({{ $post->id }})" class="mb-3">
        
        <div class="d-flex justify-content-between">
            <p id="post-count-{{ $post->id }}" class="mb-0">{{ $post->likes_count }} <span>Menyukai</span></p>
            <p id="post-count-{{ $post->id }}" class="mb-0 float-end"> {{ $post->comments_count }} <span>Komentar</span></p>
        </div>
        
        <hr class="mb-0 mt-0">
        
        
        <p class="mb-0">
            <button class="btn {{ ($post->is_like() ? 'btn-danger' : 'btn-primary') }} btn-sm mt-2" onclick="like({{ $post->id }})" id="post-like-{{ $post->id }}">
                {{ ($post->is_like() ? 'Unlike' : 'Like') }}
            </button>
    
            <a href="{{ route('post.show', [$post->id]) }}" class="btn btn-primary btn-sm mt-2">Komentar</a>
        </p>
    
        <p class="caption mb-0">
            {{ $post->caption }}    
        </p>
    </div>
</div>