<div class="commentBody">
    @foreach ($comments as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <img style="float: right" src="{{asset($post->user->profile_photo_url)}}" alt="" width="50px" class="rounded-full">
                <p class="mt-2 me-3" style="display: inline-block; "><strong>{{$comment->user->name}}</strong></p>
                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                            <i class="far fa-clock">  {{$comment->created_at->diffForHumans()}}</i>
                        </div>
                        <div class="col-4">
                            <span class="cursor-pointer reply-button">
                                <i class="fa-solid fa-reply"></i>
                                <span class="comment-date text-secondary ">إضافة رد</span>
                            </span>
                        </div>
                    </div>
                    <p class="mt-3">{{$comment->body}}</p>


                    @auth
                    <form action="{{route('reply.add')}}" method="POST" class="replay">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control @error('body') is-invalid @enderror" name="comment_body" rows="5" placeholder="أضف ردا"></textarea>
                            @error('comment_body')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">

                        <div class="form-group">
                            <button class="btn btn-outline-dark my-2" type="submit">رد</button>
                        </div>
                    </form>
                    @else
                    <div class="alert alert-info" role="alert">
                        يرجى تسجيل الدخول لكي تستطيع اضافة الرد
                    </div>
                    @endauth
                    @include('comments.all' , ['comments'=>$comment->replies])
                </div>
            </div>
        </div>
    @endforeach
</div>


@section('script')
    <script>
       $(document).ready(function(){
            $(".replay").hide(); // التأكد من إخفاء كافة حقول الرد في البداية
            
            $(".reply-button").click(function(event){
                // البحث عن حقل الرد الذي يليه فقط
                $(this).closest('.card-body').find('.replay').first().slideToggle('slow');
            });
        });
    </script>
@endsection