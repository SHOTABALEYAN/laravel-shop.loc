  @extends('layouts.user')


@section('content')
<div class="container">
    <div class="row">
     <div class="col-md-10">
     	<table class="table">
     	<thead>
      <tr>
        <th>image</th>
        <th>Name</th>
        <th>Price</th>
         <th>Qty</th>
         <th>Description</th>
         <th>Select</th>
          <th>Ceckbox</th>
          
            
      </tr>
    </thead>

    <tbody>
      @if(isset($carts))
    	@foreach($carts as $cart)<td>
<img src="images/{{$cart->options->image}}"width="200px" height="200px"></td>




<td>{{$cart->name}}</td>
<td>{{$cart->price}}</td>
<td><input type="number" class="qty form-control" id="{{$cart->rowId}}" value="{{$cart->qty}}" >

	</td>

<td>{{$cart->options->description}}</td>


<td>{{$cart->options->option}}</td>


<td>{{$cart->options->checkbox}}</td>
<td></td>
<td><button id="{{$cart->rowId}}" class="delete btn btn-danger">Delete</button>
	
</td>

 </tbody>
@endforeach

</table><div><b class="total">TOTAL={{$subtotal}}|  |  BONUSES={{$bonus}}</b>

</div>

     </div>
    

          	</div>
           
           
</div>
 
<form action="{{url('order')}}" method="get">
<input type="text" name="address" placeholder="Address" class="form-control">
<input type="text" name="phone" placeholder="Phone" class="form-control">
<div class="btn-group btn-group-justified">
  <div class="btn-group">
<input type="submit" name="order" value="Order" class="btn btn-primary">
</div>
<div class="btn-group">
<input type="submit" name="buy" value="Buy" class="btn btn-success">
</div>
</div>
</form>
@endif
<!-- 
<a href="{{url('nopay')}}" class="btn btn-primary btn-block">Order</a>
<a href="{{url('buybonus')}}" class="btn btn-success  btn-block">To Buy a Bonus</a> -->
@endsection


