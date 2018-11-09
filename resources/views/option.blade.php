@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <form action="{{url('option/create')}}" method="get">
                   <input type="text" name="option" placeholder="Write option" class="form-control">
                    <input type="text" name="O_price" placeholder="Write price" class="form-control">
                   <input type="submit" name="" value="Add Option" class="btn btn-primary btn-block">
               </form>

                </div>
               

                 <table class="table">
    <thead>
      <tr>
        <th>Option</th>
        <th>Price</th>
        <th>Edit</th>
        <th>Delete</th>
         
      </tr>
    </thead>
                   <tbody>
                    @if(isset($options))
                      @foreach($options as $option)<tr>
              <td>{{$option->option}}</td>
               <td>{{$option->O_price}}</td>
              <td>  <a href='{{url("edit/$option->id")}}' class="btn btn-primary pull-left">Edit</a></td>
              <td>  <a href='{{url("destroy/$option->id")}}'  class="btn btn-danger pull-left">Delete</a></td>
              
               </tr> @endforeach
        @endif
        </tbody>
    </table>
        
    </div>
</div>
@endsection


