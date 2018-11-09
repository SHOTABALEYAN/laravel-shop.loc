<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart as Cart;
use App\order;
use App\order_items;
use Mail;
use Session;
use App\Bonus;
use App\Mail\Mail as Mail1;
use Illuminate\Support\Facades\Input;
class OrderController extends Controller
{
	public function order(){



		$code=str_random(6);
		$cart=Cart::content();
		$order_items=new order_items;
		$order= new order;

		$order->total=Cart::subtotal();
		$order->code=$code;

		$order->address= Input::get('address');
		$order->phone= Input::get('phone');
		

		$order->save();
		$last=order::orderBy('created_at', 'desc')->first();
		$id=$last->id;

		$order_items_arr=[];

		foreach ($cart as  $value) {
			$row=[];
			$row['product_id']= $value->id;
			$row['qty']= $value->qty;
			$row['order_id'] = $id;
			$row['options']=$value->options->option;
			$row['checkbox']=$value->options->checkbox;
			$order_items_arr[] =$row;
		}

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
		$phone=Input::get('phone');
		$bonus=$subtotal/100;

		$phones=Bonus::all();
		$bonuses=new Bonus;
		$b=$phones->toArray();
		$b1=[];
		foreach ($phones as $key => $value) {
			array_push($b1, $value->phone);

		}

		if (isset($_GET['order'])) {    
			if (array_search($phone, $b1)) {
				$b2=Bonus::where('phone',$phone)->get();


				foreach ($b2 as  $value) {

					$request['bonus']=$value->bonus+$bonus;
					$value->update($request);

				}

			}


			else{

				$bonuses->phone=$phone;
				$bonuses->bonus=$bonus;
				$bonuses->save();
			}
			order_items::insert($order_items_arr);
			$str1=$code.'->'. Input::get('address').'->'.Input::get('phone');
			$str=join(' ',$order_items_arr[0]);
			$order='This is order';
			session(['code'=>$code,'str'=>$str,'str1'=>$str1,'total'=>$subtotal,'order'=>$order]);
			return view('ok');


		}

		else{
			if (array_search($phone, $b1)) {
				$b2=Bonus::where('phone',$phone)->get();
				foreach ($b2 as  $value) {
					if ($value->bonus>$bonus) {


						$request['bonus']=$value->bonus-$bonus;
						$value->update($request);

					}
					else{
						return redirect()->back();
					}
				}
				order_items::insert($order_items_arr);
				$str1=$code.'->'. Input::get('address').'->'.Input::get('phone');
				$str=join(' ',$order_items_arr[0]);
				$order='To buy a bonus';
				session(['code'=>$code,'str'=>$str,'str1'=>$str1,'total'=>$subtotal,'order'=>$order]);
				return view('ok');

			}

		}
	}


}
