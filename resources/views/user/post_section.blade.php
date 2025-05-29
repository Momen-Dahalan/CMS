@includeWhen(!count($contents->posts), 'alerts.empty', ['msg' => "لا توجد أي مشاركات بعد"])

@foreach ($contents->posts as $post)
    <div class="row mb-2">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- صورة المستخدم واسم المستخدم -->
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/storage/'.$post->user->profile_photo_path) }}" alt="" class="h-12 w-12 rounded-circle object-cover">
                                <p class="mt-2 ms-3 mb-0"><strong>{{ $post->user->name }}</strong></p>
                            </div>

                            <!-- الأزرار في الزاوية اليمنى -->
                            @auth
                                <div class="d-flex">
                                    @can('edit-post' ,$post)
                                        <form action="{{ route('post.edit', $post->id) }}" method="GET" class="me-2">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="btn btn-warning btn-sm">
                                                <i class="far fa-edit text-white fa-lg"></i>
                                            </button>
                                        </form> 
                                    @endcan
                                   

                                    {{-- بدي اقارن الدور الذي ينتمي اليه المستخدم الحالي مع الدور الذي تنتمي الصلاحية المعطاه --}}
                                    @can('delete-post' , $post)
                                        
                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('هل أنت متاكد من حذف المنشور')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash text-white fa-lg"></i>
                                        </button>
                                    </form>

                                    @endcan

                                </div>
                            @endauth
                        </div>
                    </div>

                    <!-- تفاصيل المنشور -->
                    <div class="row mt-2">
                        <div class="col-3">
                            <i class="far fa-clock"><span class="text-secondary"> {{ $post->created_at->diffForHumans() }}</span></i>
                        </div>
                        <div class="col-3">
                            <i class="fa-solid fa-align-justify"><span class="text-secondary"> {{ $post->category->title }}</span></i>
                        </div>
                        <div class="col-3">
                            <i class="fa-solid fa-comment"><span class="text-secondary"> {{ $post->comments->count() }} تعليقات</span></i>
                        </div>
                    </div>

                    <!-- العنوان والمحتوى المختصر -->
                    <h4 class="my-2 h4"><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h4>
                    <p class="card-text mb-2">{!! Str::limit($post->body, 200) !!}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
