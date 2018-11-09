@extends('layouts.app')

@section('content')
<div class="container">
<form method="post" action='{{url("Pcreate/$id")}}' enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" placeholder="title" name="title"class="form-control">
    <textarea placeholder="description" name="description"class="form-control"></textarea>
    <input type="text" placeholder="Price" name="price"class="form-control">
     <input type="text" placeholder="Options" name="options"class="form-control">
      <input type="text" placeholder="checkbox" name="checkbox"class="form-control">
    <input type="file" name="image">
    <input type="submit" name="add" value="Add News" class="btn btn-primary  btn-block">
</form>




<table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
         <th>Price</th>
         <th>options</th>
         <th>checkbox</th>
         
      </tr>
    </thead>
            
@foreach($products->reverse() as $product)
 <tbody>
<td>{{$product->title}}</td>
<td>{{$product->description}}</td>
<td><img src='{{asset("/images/$product->image")}}' width="200px" height="200px"></td>

<td>{{$product->price}}</td>
<td><a href='{{url("/option/$product->id")}}' btn btn-primary>option</a></td>

<td>{{$product->checkbox}}</td>

</tbody>
@endforeach

</table>
{{$products->links()}}
</div>

@endsection
<style type="text/css">
	iframe{
		width: 200px;
		height: 200px;
	}
</style>
