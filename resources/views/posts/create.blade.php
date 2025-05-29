@extends('layouts.main')

@section('content')
<div class="container-xl my-4"><!-- حاوية بعرض كبير ومركز -->
    <div class="row g-4"><!-- صف مع مسافة بين الأعمدة (g-4) -->

        <!-- عمود النموذج (الفورم) -->
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2 class="h5 mb-0 text-center">أضف موضوعًا جديدًا</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- اختيار التصنيف -->
                        <div class="mb-3">
                            <label for="category" class="mb-2">التصنيف</label>
                            <select class="form-select" name="category_id" id="category">
                                @include('lists.categories')
                            </select>
                        </div>

                        <!-- عنوان المنشور -->
                        <div class="mb-3">
                            <label for="title" class="mb-2">عنوان المنشور</label>
                            <input type="text"
                                   id="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   name="title"
                                   placeholder="حدد عنوان الموضوع"
                                   value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- محتوى المنشور -->
                        <div class="mb-3">
                            <label for="body" class="mb-2">محتوى المنشور</label>
                            <textarea id="body"
                                      class="form-control @error('body') is-invalid @enderror"
                                      name="body"
                                      rows="5">{{ old('body') }}</textarea>
                            @error('body')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- إضافة الصورة -->
                        <div class="mb-3">
                            <label for="image" class="mb-2">رفع صورة</label>
                            <div class="custom-file">
                                <input type="file"
                                       class="custom-file-input @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       accept="image/*"
                                       onchange="readCoverImage(this)">
                                <label class="custom-file-label" for="image">اختر صورة</label>
                            </div>
                            @error('image')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- عرض صورة المعاينة -->
                        <div class="mb-3">
                            <img id="cover-image-thumb"
                                 class="img-fluid"
                                 style="display: none; border-radius: 10px; object-fit: cover;"
                                 width="100"
                                 height="100">
                        </div>

                        <button type="submit" class="btn btn-outline-dark d-block mx-auto">نشر</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- عمود السايدبار -->
        <div class="col-12 col-lg-4">
            @include('partials.sidebar')
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
    // دالة لقراءة وعرض صورة المعاينة عند اختيارها
    function readCoverImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var imgThumb = document.getElementById('cover-image-thumb');
                imgThumb.setAttribute('src', e.target.result);
                imgThumb.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // محرر النصوص
    ClassicEditor
        .create(document.querySelector('#body'), {
            toolbar: ['heading','|','bold','italic','link','bulletedList','numberedList','blockQuote','insertTable','imageUpload','mediaEmbed'],
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
