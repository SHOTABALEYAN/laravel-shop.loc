<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;
use App\CategoryModel;
use \Cart as Cart;
use App\option;
class ProductController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index($id)
{
   $products=ProductModel::where('cat_id',$id)->paginate(10);

   return view('product')->with(["products"=>$products,"id"=>$id]);

}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create(Request $request,$id)
{
   if ($request->hasFile('image')) {
    if($request->file('image')->isValid()) {
        try {
            $file = $request->file('image');
            $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $request->file('image')->move("images", $name);
        } catch (Illuminate\Filesystem\FileNotFoundException $e) {

        }
    }
    
    $product= new ProductModel;
    $product->title= $request->input('title');
    $product->description= $request->input('description');
    $product->price= $request->input('price');

/*








  
$product->options= $request->input('options');*/



$product->checkbox= $request->input('checkbox');
$product->cat_id= $id;
$product->image=$name;

$product->save();


$last=ProductModel::orderBy('created_at', 'desc')->first();
$id=$last->id;







$option=$request->input('options');
$arr_option=explode(',', $option);

$option_arr=[];
for ($i=0; $i <count($arr_option) ; $i++) { 
    $arr_option1=explode(':',$arr_option[$i]);
    $opt_row=[];
    $opt_row['prod_id']=$id;
    $opt_row['option']=$arr_option1[0];
    $opt_row['O_price']=$arr_option1[1];
    $option_arr=$opt_row;
    option::insert($option_arr);
}
return redirect()->back();
}
else{
    echo "string";
}
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
    //
}



/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show($id)
{
    $categories=CategoryModel::all();
    $products=ProductModel::where('cat_id',$id)->paginate(4);

    return view('user')->with(["products"=>$products,"id"=>$id,"categories"=>$categories]);
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    //
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, $id)
{
    //
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    //
}
public function addcart($id){
    $products=ProductModel::where('id',$id)->get();
    $options=option::where('prod_id',$id)->get();

    foreach ($products as $product) {
     foreach ($options as  $option) {
       # code...




         Cart::add(['id' => $product->id, 'name' => $product->title, 'qty' => 1, 'price' =>$product->price ,'options' => ['options' => $option->option.'->'.$option->O_price,'image'=>$product->image,'checkbox'=>$product->checkbox,'description'=>$product->description]]);
     }
 }
//'options' => $options->option.'->'.$options->O_price,

}
public function cart(){
    $carts=Cart::content();

    foreach ($carts as $key => $value) {
        static $sum=0;
        static $price=0;
        $sum1=explode('+',$value->options->option );
        $qty1=$value->qty;
        $sum+=$sum1[1]*$qty1;
        $price1=$value->price;
        $price+=$price1*$qty1;


    }


    $subtotal=$price+$sum;
    $bonus=$subtotal/100;
    return view('cart')->with(["carts"=>$carts,"subtotal"=>$subtotal,'bonus'=>$bonus]);

    
}
public function delcart($id){
    Cart::remove($id);
    return  redirect()->action('ProductController@cart');
}
public function updateCart($id,$val){
    Cart::update($id,['qty'=>$val]);
     $carts=Cart::content();

    foreach ($carts as $key => $value) {
        static $sum=0;
        static $price=0;
        $sum1=explode('+',$value->options->option );
        $qty1=$value->qty;
        $sum+=$sum1[1]*$qty1;
        $price1=$value->price;
        $price+=$price1*$qty1;


    }


   echo  'TOTAL='.$subtotal=$price+$sum.'|   |';
   echo 'BONUSES='. $bonus=$subtotal/100;

}
/*public function updateSelect($id,$val){

   $item = Cart::get($id);
   $option = $item->options->merge(['options' => $val]);

   Cart::update(
    $id, [

        'options' => $option
    ]);

}

public function updateCheckbox($id,$val){
    $item=Cart::get($id);
    $option=$item->options->merge(['checkbox'=>$val]);

    Cart::update(
        $id, [

            'checkbox' => $option
        ]);

}*/


public function more($id){
    $products=ProductModel::where('id',$id)->get();
    $options=option::where('prod_id',$id)->get();
    return view('more')->with(['products'=>$products,'options'=>$options]);
}
}
