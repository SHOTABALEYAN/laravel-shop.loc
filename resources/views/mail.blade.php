@extends('layouts.user')

<?php
$carts=(session()->get('cart'));


?>




@section('content')
<div class="container">
    <div class="row">
     <div class="col-md-12">
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
           <th>Order OR Buy</th>
            <th>Total</th>
      </tr>
    </thead>

    <tbody>
   
    	@foreach($carts as $cart1)
    	@foreach($cart1 as $cart)
    	<td>
<?php  $c= $cart->options->image;

?>
<img src='{{asset("/images/$c")}}' width="200px" height="200px"></td>




<td>{{$cart->name}}</td>
<td>{{$cart->price}}</td>
<td><input type="number" class="qty" id="{{$cart->rowId}}" value="{{$cart->qty}}">

	</td>

<td>{{$cart->options->description}}</td>


<td>{{$cart->options->option}}</td>


<td>{{$cart->options->checkbox}}</td>

	
</td>
<td>{{session()->get('order')}}</td>
<td>{{session()->get('total')}}</td>
 </tbody>
@endforeach
@endforeach