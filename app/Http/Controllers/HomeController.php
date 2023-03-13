<?php

namespace App\Http\Controllers;
//request
use Illuminate\Http\Request;

//database class
//use Illuminate\Support\Facades\DB;
use DB;

class HomeController extends Controller{
	public function index($id){
		$arr = ['name'=>'Mahdi','age'=>12];
		return response()->json($arr) //get json_encode response with json type header
		->header('name','name');
	}

	public function redirect(){
		return redirect('/name/md'); //add route path
	}

	public function download(){
		return response()->download(".env"); //add root file path
	}

	public function catch(Request $request){
		return $request; //show json/form-data/uri request data
		//return $request->header(); //get request header
	}

	public function dbtest(){
		//return DB::select("SELECT * FROM students"); //query  //select,insert,update,delete
		return DB::table('students')->get(); //query builder  //https://laravel.com/docs/10.x/queries
	}
}