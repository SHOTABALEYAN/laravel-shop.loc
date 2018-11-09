<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;
use App\CategoryModel;
use \Cart as Cart;
class CartController extends Controller
{

	public function AddCart(Request $request,$id){
		$products=ProductModel::where('id',$id)->get();
 foreach ($products as $product) {
       Cart::add(['id' => $product->id, 'name' => $product->title, 'qty' => 1, 'price' =>$product->price ,'options' => ['option'=>$request->option,'image'=>$product->image,'checkbox'=>$product->checkbox,'description'=>$product->description]]);
       }

     return redirect()->back();

    /* 
       // $options=option::where('prod_id',$id)->get();

      
   }*/
}
}
