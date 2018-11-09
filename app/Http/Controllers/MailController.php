<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\Mail as Mail1;
use Session;
use Cart;
class MailController extends Controller
{
    public function send(){
    	$mail='shotabaleyan1@gmail.com';
    	Mail::to($mail)->send(new Mail1);
    	Cart::destroy();
    	session()->flush();
    	return redirect()->action('CategoryController@show');
    	
    }
}
