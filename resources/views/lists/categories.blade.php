@foreach ($categories as $cat)
    <option value="{{$cat->id}}">{{$cat->title}}</option>
@endforeach