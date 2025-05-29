@extends('layouts.main')

@section('content')
<div class="col-md-12">
    <h2 class="h4 my-4">تعديل المنشور</h2>
</div>

<div class="col-md-8 bg-white py-3">
    <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        
        <!-- اختيار التصنيف -->
        <label for="category" class="mb-2">التصنيف</label>
        <div class="input-group mb-3">
            <select class="form-select" name="category_id" id="category">
                <option value="{{$post->category_id}}">{{$post->category->title}}</option>
                @include('lists.categories')
            </select>
        </div>

        <!-- عنوان المنشور -->
        <label for="title" class="mb-2">عنوان المنشور</label>
        <div class="input-group mb-3">
            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="حدد عنوان الموضوع" value="{{ old('title', $post->title) }}">
            @error('title')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- محتوى المنشور -->
        <label for="body" class="mb-2">محتوى المنشور</label>
        <div class="input-group mb-3">
            <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" rows="3">{{ old('body', $post->body) }}</textarea>
            @error('body')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- إضافة الصورة -->
        <label for="image" class="mb-2">رفع صورة</label>
        <div class="input-group mb-3">
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
        <div class="row">
            @if($post->image_path) 
                <img id="cover-image-thumb" class="col-2 my-3" width="30px" height="30px" style="display: block; border-radius: 10px; object-fit: cover;" src="{{Storage::url('public/'.$post->image_path)}}"">
            @else
                <img id="cover-image-thumb" class="col-2 my-3" width="30px" height="30px" style="display: none; border-radius: 10px; object-fit: cover;">
            @endif
        </div>

        <button type="submit" class="btn btn-outline-dark my-3 ">تحديث</button>
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
