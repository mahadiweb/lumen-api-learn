<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Todo extends Controller{
	public function Read($id=null){
		if ($id == null) {
			$datas = DB::table('students')->get();
			return response()->json($datas);
		}else{
			$data = DB::table('students')->find($id);
			return response()->json($data);
		}
		
	}

	public function Create(Request $request){

		$this->validate($request, [
			'name'=>'required',
			'email'=>'required|email',
			'mobile'=>'required|numeric|min:11|max:11|digits:10'
		]);

		$name = $request->input('name');
		$email = $request->input('email');
		$mobile = $request->input('mobile');

		$insert = DB::table('students')->insert(['name'=>$name,'email'=>$email,'mobile'=>$mobile]);

		if ($insert) {
			return response()->json("Data Created!");
		}else{
			return response()->json("Error!");
		}
	}

	public function Update(Request $request){
		$id = $request->input('id');
		$name = $request->input('name');
		$email = $request->input('email');
		$mobile = $request->input('mobile');

		$update = DB::table('students')->where('id',$id)->update(['name'=>$name,'email'=>$email,'mobile'=>$mobile]);

		if ($update) {
			return response()->json("Data Updated!");
		}else{
			return response()->json("Error!");
		}
	}

	public function Delete(Request $request){
		$id = $request->input('id');

		$delete = DB::table('students')->delete($id);

		if ($delete) {
			return response()->json("Data Deleted!");
		}else{
			return response()->json("Error!");
		}
	}

	public function Login(Request $request){
		$username = $request->input('username');
		$password = $request->input('password');

		$login = DB::table('users')->where(['username'=>$username,'password'=>$password])->count();

		if ($login == 1) {
			$key = env('JWT');
			$payload = [
			    'name' => 'Mahdi',
			    'email' => 'test@gmail.com',
			    //'iss' => 'http://example.org',
			    //'aud' => 'http://example.com',
			    'iat' => time(),
			    'exp' => time()+60
			];
			$token = JWT::encode($payload, $key, 'HS256');

			return response()->json([
				"status"=>"Success",
				"token"=>$token
			]);
		}else{
			return response()->json([
				"status"=>"Fail",
			]);
		}
	}
}