@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <form action="{{url('create')}}" method="get">
                   <input type="text" name="category" placeholder="Write Category" class="form-control">
                   <input type="submit" name="" value="Add Category" class="btn btn-primary btn-block">
               </form>

                </div>
               

                 <table class="table">
    <thead>
      <tr>
        <th>Category</th>
        <th>Edit</th>
        <th>Delete</th>
         <th>Products</th>
      </tr>
    </thead>
                   <tbody>
                    @if(isset($categories))
                      @foreach($categories as $category)<tr>
              <td>{{$category->category}}</td>
              <td>  <a href='{{url("edit/$category->id")}}' class="btn btn-primary pull-right">Edit</a></td>
              <td>  <a href='{{url("destroy/$category->id")}}'  class="btn btn-danger pull-right">Delete</a></td>
               <td>  <a href='{{url("product/$category->id")}}'  class="btn btn-success pull-right">Products</a></td>
               </tr> @endforeach
        @endif
        </tbody>
    </table>
        
    </div>
</div>
@endsection

