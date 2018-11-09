  @extends('layouts.user')


@section('content')

<form action="{{url('order')}}" method="get">
<input type="text" name="address" placeholder="Address" class="form-control">
<input type="text" name="phone" placeholder="Phone" class="form-control">

<input type="submit" name="add" value="Order" class="btn btn-primary  btn-block">


</form>

@endsection