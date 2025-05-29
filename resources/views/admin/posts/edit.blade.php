@extends('layouts.main')

@section('content')
<div class="col-md-12">
    <h2 class="h4 my-4">تعديل المنشور</h2>
</div>

<div class="col-md-8 bg-white py-4 px-5 shadow-sm rounded">
    <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        
        <!-- اختيار التصنيف -->
        <label for="category" class="mb-2">التصنيف</label>
        <div class="input-group mb-4">
            <select class="form-select" name="category_id" id="category">
                <option value="{{$post->category_id}}">{{$post->category->title}}</option>
                @include('lists.categories')
            </select>
        </div>

        <!-- عنوان المنشور -->
        <label for="title" class="mb-2">عنوان المنشور</label>
        <div class="input-group mb-4">
            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="حدد عنوان الموضوع" value="{{ old('title', $post->title) }}">
            @error('title')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-row mb-4">
            <div class="col-lg-6 form-group">
                <label for="slug">الاسم اللطيف</label>
                <input type="text" class="form-control" name="slug" id="slug" value="{{ $post->slug }}">
            </div>  
            <div class="col-lg-6 form-group d-flex align-items-center">
                <label for="approved" class="me-2">نشر الموضوع</label>
                <input type="checkbox" name="approved" id="approved" {{ $post->approved ? 'checked' : '' }}>
            </div>  
        </div>

        <!-- محتوى المنشور -->
        <label for="body" class="mb-2">محتوى المنشور</label>
        <div class="input-group mb-4">
            <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" rows="4">{{ old('body', $post->body) }}</textarea>
            @error('body')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- إضافة الصورة -->
        <label for="image" class="mb-2">رفع صورة</label>
        <div class="input-group mb-4">
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" onchange="readCoverImage(this)">
                <label class="custom-file-label" for="image">اختر صورة</label>
            </div>
            @error('image')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- عرض صورة المعاينة -->
        <div class="row mb-4">
            @if($post->image_path) 
                <img src="{{asset('/storage/images/'.$post->image_path)}}" id="cover-image-thumb" class="col-2 my-3" width="60px" height="60px" style="display: block; border-radius: 10px; object-fit: cover;" >
            @else
                <img id="cover-image-thumb" class="col-2 my-3" width="60px" height="60px" style="display: none; border-radius: 10px; object-fit: cover;">
            @endif
        </div>

        <button type="submit" class="btn btn-outline-dark mt-4">تحديث</button>
    </form>
</div>

@include('partials.sidebar')
@endsection

@section('script')
    <script>
        // لقراءة وعرض صورة المعاينة عند رفعها
        function readCoverImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var imgThumb = document.querySelector('#cover-image-thumb');
                    imgThumb.setAttribute('src', e.target.result);
                    imgThumb.style.display = 'block'; // عرض الصورة
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        ClassicEditor
            .create(document.querySelector('#body'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'imageUpload', 'mediaEmbed'],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
