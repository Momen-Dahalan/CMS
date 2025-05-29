@extends('admin.theme.default')

@section('title' , 'التصنيفات')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i>إضافة التصنيفات
                <form action="{{route('category.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="التصنيف">
                            @error('title')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-dark">حفظ</button>
                        </div>

                    </div>
                </form>
            </div>



            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>التصنيف</th>
                                <th>الاسم اللطيف</th>
                                <th>تاريخ الانشاء</th>
                                <th>حذف</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($categories as $cat)
                                <tr>
                                    <td>{{$cat->id}}</td>
                                    <td>{{$cat->title}}</td>
                                    <td>{{$cat->slug}}</td>
                                    <td>{{$cat->created_at}}</td>
                                    <td>
                                        <form action="{{route('category.destroy', $cat->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-link" style="background-color: white; border: none"><i class="far fa-trash-alt text-danger fa-lg"></i></button>
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