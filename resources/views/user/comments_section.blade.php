@includeWhen(!count($contents->comments), 'alerts.empty', ['msg' => 'لا توجد اي تعليقات بعد '])

@foreach ($contents->comments as $comment)
    <div class="card mt-4 mb-3">
        <div class="card-body">
            <div class="row">
                <!-- صورة المستخدم -->
                <div class="col-md-2 d-flex justify-content-center align-items-start">
                    <img src="{{ Storage::url($comment->user->profile_photo_path) }}" alt="" width="80px" height="80px" class="rounded-circle">
                </div>

                <!-- محتوى التعليق -->
                <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- اسم المستخدم وتاريخ التعليق -->
                        <div>
                            <p class="mb-1"><strong>{{ $comment->user->name }}</strong></p>
                            <span class="text-muted"><i class="far fa-clock"></i> {{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <!-- زر الحذف -->
                        @auth
                        @can('delete-post' , $comment)
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف التعليق؟')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash text-white"></i>
                                </button>
                            </form>
                        @endcan
                     
                        @endauth
                    </div>
                    
                    <!-- نص التعليق -->
                    <div class="mt-3">
                        <a href="{{ route('post.show', $comment->post->slug) }}#comments">
                            <p class="text-secondary">{{ Str::limit($comment->body, 250) }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
