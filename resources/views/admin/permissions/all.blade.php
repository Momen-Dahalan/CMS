@extends('admin.theme.default')

@section('title', 'تعيين الصلاحيات الى الأدوار')


@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <form action="{{ route('permissions') }}" method="POST" class="mt-3">
                @csrf

                <div class="card-header">
                    <div class="col-lg-6 form-group">
                        <label for="role_id">حدد الدور</label>
                        <select name="role_id" id="role_id" class="form-control">
                            @include('lists.roles')
                        </select>
                    </div>
                </div>

        


                <div class="card-body row">
                    @foreach ($permissions as $per)
                        <div class="col-lg-4">
                            <label for="permission">
                                <input type="checkbox" class="" name="permission[]" value="{{ $per->id }}" {{$per->roles()->find(1)? "checked" : ''}}>
                                {{ $per->description }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer small text-muted">
                    <input type="submit" class="btn btn-dark" value="حفظ">
                </div>

            </form>
        </div>
    </div>
@endsection




@extends('admin.theme.default')

@section('title', 'تعيين الصلاحيات الى الأدوار')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <form action="{{ route('permissions') }}" method="POST" class="mt-3">
                @csrf

                <div class="card-header">
                    <div class="col-lg-6 form-group">
                        <label for="role_id">حدد الدور</label>
                        <select name="role_id" id="role_id" class="form-control">
                            @include('lists.roles')
                        </select>
                    </div>
                </div>

                <div class="card-body row">
                    @foreach ($permissions as $per)
                        <div class="col-lg-4 mb-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]"
                                    value="{{ $per->id }}" id="permission-{{ $per->id }}">
                                <label for="permission-{{ $per->id }}" class="form-check-label">
                                    {{ $per->description }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer text-muted text-end">
                    <input type="submit" class="btn btn-dark" value="حفظ">
                </div>

            </form>
        </div>
    </div>
@endsection



@section('script')
<script>
    $('#role_id').on('change', function(event) {
        var role_id = $(this).val();
        var token = "{{ csrf_token() }}";

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: '{{ route("permission_byRole") }}',
            method: "GET",
            data: {
                'id': role_id
            },
            success: function(data) {
                // First, uncheck all checkboxes
                $('input[type="checkbox"]').prop('checked', false);

                // Then, check only the permissions that are in the returned data
                $('input[type="checkbox"]').each(function() {
                    var permissionId = parseInt(this.value);
                    if (data.includes(permissionId)) {
                        $(this).prop('checked', true);
                    }
                });
            },
            
        });
    });
</script>
@endsection
