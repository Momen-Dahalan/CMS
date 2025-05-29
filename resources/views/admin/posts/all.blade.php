@extends('admin.theme.default')

@section('title', 'المنشورات')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> المنشورات
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>العنوان</th>
                                <th>الاسم اللطيف</th>
                                <th>المحتوى</th>
                                <th>الكاتب</th>
                                <th>النشر</th>
                                <th>التصنيف</th>
                                <th>تعديل</th>
                                <th>حذف</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->slug }}</td>
                                    <td>{{ Str::limit($post->body, 200) }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    
                                    <!-- Checkbox للنشر -->
                                    <td><input type="checkbox" name="approved" value="{{$post->approved }}" {{$post->approved ? 'checked' : ''}}></td>
                                    
                                    <td>{{ $post->category->title }}</td>
                                    
                                    <!-- زر التعديل -->
                                    <td>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-link float-left" style="background-color: white; border: none">
                                            <i class="far fa-edit text-warning fa-lg"></i>
                                        </a>
                                    </td>
                                    
                                    <!-- زر الحذف -->
                                    <td>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف المنشور؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link" style="background-color: white; border: none">
                                                <i class="far fa-trash-alt text-danger fa-lg"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
