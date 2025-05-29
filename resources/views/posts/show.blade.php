@extends('layouts.main')

@section('style')
   <style>
        .post-img {
            max-width: 65%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .post-author-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-left: 10px;
            margin-right: 10px;
        }
   </style>
@endsection

@section('content')
    <h2 class="h4 my-4">{{$post->title}}</h2>
    <input type="hidden" id="postId" value="{{$post->id}}">
    <div class="col-md-8">
        <div class="bg-white p-5">
            <div class="post-header">
                
                <img src="{{asset($post->user->profile_photo_url)}}" alt="{{asset($post->user->name)}}" class="post-author-img">
                <p class="mt-2"><strong>{{$post->user->name}}</strong></p>
            </div>

            <div class="row mt-2">
                <div class="col-3">
                    <i class="far fa-clock"><span class="text-secondary">  {{$post->created_at->diffForHumans()}}</span></i>
                </div>
                <div class="col-3">
                    <i class="fa-solid fa-align-justify"><span class="text-secondary">  {{$post->category->title}}</span></i>
                </div>
                <div class="col-3">
                    <i class="fa-solid fa-comment"><span class="text-secondary">  {{$post->comments->count()}} تعليقات</span></i>
                </div>  
            </div>    

            @if ($post->image_path != null)
                <img class="mb-4 post-img" src="{{Storage::url('public/'.$post->image_path)}}" alt="" width="400px">
            @endif
            
            <p class="lh-lg">{!!$post->body!!}</p>
            @auth
            <div class="row form-group mt-5">
                <div class="col-lg-12 col-md-6 col-xs-11">
                    <form action="{{route('comment.store')}}" method="post" id="comments" >
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="5" placeholder="أضف تعليقا"></textarea>
                            @error('body')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-dark mt-3">تعليق</button>
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                    </form>
                </div>
            </div>
            @else
            <div class="alert alert-info" role="alert">
                يرجى تسجيل الدخول لكي تستطيع وضع تعليق
            </div>
            @endauth
        </div>

        <div class="p-0 word-break contianer mt-5">
            <h4 class="mb-5">التعليقات</h4>
            @include('comments.all' , ['comments' =>$comments , 'post_id' =>$post->id])
        </div>


    </div>

    <div class="col-md-4">
        @include('partials.sidebar')
    </div>
@endsection
