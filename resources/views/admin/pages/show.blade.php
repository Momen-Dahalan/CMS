@extends('layouts.main')

@section('content')
<div class="row">
    {{-- Main Content --}}
    <div class="col-md-8 bg-white" style="height: fit-content;">
        <h2 class="my-4">{{ $page->title }}</h2>
        {!! $page->content !!} 
    </div>

    {{-- Sidebar --}}
    <div class="col-md-4">
        @include('partials.sidebar')
    </div>
</div>
@endsection
