
@extends('layouts.app')

@section('content')

<form action='{{url("update/$category->id")}}' method="get">
	 <input type="text" value="{{$category->category}}" name="category"class="form-control">
	   <input type="submit" class="btn btn-primary" value="update">
</form>
@endsection