@extends('layouts.main')

@section('content')

    <div class="col-md-12">
        <p class="h4 my-4">{{$title}}</p>
    </div>

    <div class="col-md-8">

        @includeWhen(count($posts)==0,'alerts.empty' ,['msg'=> 'لا توجد منشورات'] )
        {{-- @if (count($posts)==0)
        <div class="alert alert-secondary text-center">
            لا توجد منشورات
        </div>
        @endif --}}
        @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        {{-- <img class="h-12 w-12 rounded-full object-cover" style="float: right" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" /> --}}
                        {{-- <img src="{{asset($post->user->profile_photo_url)}}" alt=""  style="float: right" class="h-12 w-12 rounded-full object-cover"> --}}
                        <img src="{{asset($post->user->profile_photo_url)}}" alt=""  style="float: right" class="h-12 w-12 rounded-full object-cover">
                        <p class="mt-2 me-3" style="display: inline-block"><strong>{{$post->user->name}}</strong></p>

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

                        <h4 class="my-2 h4"><a href="{{route('post.show' , $post->slug)}}">{{$post->title}}</a></h4>
                        <p class="card-text mb-2">{!!Str::limit($post->body , 200)!!}</p>


                    </div>
                </div>
            </div>
        </div>
        @endforeach


        <ul class="pagination justify-content-center mb-4">
            {{$posts->links()}}
        </ul>

    </div>

    <div class="col-md-4">
        @include('partials.sidebar')
    </div>

    
@endsection