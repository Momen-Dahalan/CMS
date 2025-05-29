<div class="card shadow-sm mb-4">
    <div class="card-header">
        التصنيفات
    </div>
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ url('/') }}" class="text-dark text-decoration-none">
                    جميع التصنيفات ({{ $post_number }})
                </a>
            </li>
            @foreach ($categories as $cat)
                <li class="list-group-item">
                    <a href="{{ route('category', [$cat->id, $cat->slug ?? '']) }}"
                       class="text-dark text-decoration-none">
                        {{ $cat->title }} ({{ $cat->posts->count() }})
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header text-right">
        آخر التعليقات
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($recent_comments as $comment)
            <li class="list-group-item">
                @if($comment->post && $comment->post->slug)
                    <a href="{{ route('post.show', $comment->post->slug) }}#comment"
                       class="d-flex align-items-center text-decoration-none text-dark">
                        <img src="{{asset($comment->user->profile_photo_url)}}"
                             alt="{{ $comment->user->name }}"
                             width="40"
                             class="rounded-circle me-2">

                        <div>
                            <strong class="d-block">{{ $comment->user->name }}</strong>
                            <span class="text-muted">
                                {{ Str::limit($comment->body, 60) }}
                            </span>
                        </div>
                    </a>
                @else
                    <span class="text-muted">
                        التعليق غير مرتبط بمنشور صالح
                    </span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
