@extends('layouts.user')


<h1>this is your code ----->{{session()->get('code')}}</h1><a href="{{url('/send')}}" class="btn btn-primary  btn-block">Patvirel</a>