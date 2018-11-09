  @extends('layouts.user')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
          <ul class="list-group">
            @if(isset($code))
This is your order's code {{$code}}
            @endif
            @if(isset($categories))
 @foreach($categories as $category)
              <li class="list-group-item"><a href='{{url("Uproduct/$category->id")}}'>{{$category->category}}</a></li>
            
                @endforeach
                 @endif
</ul>
        </div>
      
    

   
        <div class="col-md-7">
<table class="table">
    <thead>
      <tr>
        <th>Products</th>
        
      </tr>
    </thead>
      @if(isset($products))      
@foreach($products->reverse() as $product)
 <tbody>
  <td><img src='{{asset("/images/$product->image")}}' width="200px" height="200px"></td>
<td><b>{{$product->title}}</b><hr>
{{$product->description}}<br>
<span >date-{{$product->created_at}}</span>
<hr>

<a href='{{url("more/$product->id")}}'class='btn btn-success pull-right' >More</a>
</td>

</tbody>
@endforeach

</table>
{{$products->links()}}
</div>
@endif



</div>
</div>
@endsection
<style type="text/css">
  iframe{
    width: 200px;
    height: 200px;
  }
  span{
    font-size: 14px;
    color: blue;
  }
</style>
