@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Notifications</div>

                <div class="card-body">
                    @foreach ($notifs as $notif)
                        <li>
                            <a href="{{ route('post.show', $notif->post->id) }}" class="{{ ($notif->seen) ? 'text-dark' : '' }} text-decoration-none">
                                {{ $notif->message }} ({{ $notif->created_at->diffForhumans() }})
                            </a>
                        </li>
                    @endforeach

                    {{ $notifs->links()  }}

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // saat menunya dibuka 
    // semuaan seennya true lewat ajax
    fetch('notif/seen')
    .then(response => response.json())
    .catch(error => console.log(error))
</script>
@endsection
