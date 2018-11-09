  @extends('layouts.user')


@section('content')
<div class="container">
    <div class="row">
     <div class="col-md-9">
     	<table class="table">
     	<thead>
      <tr>
        <th>image</th>
        <th>Name</th>
        <th>Price</th>
        
         <th>Description</th>
         <th>Select</th>
          <th>Options</th>
           <th>BONUS</th>
            
      </tr>
    </thead>

    <tbody> 
      @foreach($products as $product)
      <form action='{{url("/AddCart/$product->id")}}' method="post">
        {{ csrf_field() }}
    
<td><img src='{{asset("/images/$product->image")}}'width="200px" height="200px" class="img-thumbnail"></td>




<td name=title>{{$product->title}}</td>
<td name='price'>{{$product->price}}</td>


<td name=description>{{$product->description}}</td>
@endforeach
<td><select name="option" class="form-control">
@foreach($options as $option)
<option >{{$option->option}}+{{$option->O_price}}</option>
@endforeach
</select></td>


<td name=checkbox>
  @foreach($products as $product)
 
  {{$product->checkbox}}
@endforeach
</td>
<td>1%</td>

</tbody>

</table>
<input type="submit" name="" class="btn btn-primary pull-right" value="Add Cart">
</form>
@endsection


