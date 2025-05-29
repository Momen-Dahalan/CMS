@extends('admin.theme.default')

@section('title' , 'الأدوار')


@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i>الأدوار
                <form action="{{route('role.store')}}" method="POST" class="mt-3">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="الاسم">
                            @error('name')
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
                                <th>الدور</th>
                                <th>حذف</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{$role->role}}</td>
                                    <td>
                                        <form action="{{route('role.destroy', $role->id)}}" method="POST" onsubmit="return confirm('هل انت متاكد من حذف هذا الدور')">
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