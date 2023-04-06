<?php
 
namespace App\Http\Controllers;
use DB;
use Crypto;
use Lang;
class RegController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show()
    {
  if(isUserAuth()) {
   // return redirect('/photo');
  }

        return view('reg.reg');

    }


    

























































    public function makeReg(){





  if(isUserAuth()) {
   // return redirect('/feed');
  }
  if(empty($_POST['reg_submit'])) {
    return view('reg.reg');
  }

  $reg_first_name_0 = $_POST['reg_first_name'];
  $reg_last_name_0 = $_POST['reg_last_name'];
  $reg_login_0 = $_POST['reg_login'];
  $reg_email_0 = $_POST['reg_email'];
  $reg_password_0 = $_POST['reg_password'];

  $reg_first_name_length_0 = mb_strlen($reg_first_name_0);
  $reg_last_name_length_0 = mb_strlen($reg_last_name_0);
  $c = mb_strlen($reg_login_0);
  $reg_email_length_0 = mb_strlen($reg_email_0);
  $reg_login_length_0 = mb_strlen($reg_login_0);
  $reg_password_length_0 = mb_strlen($reg_password_0);
    
  $is_email_registered = DB::table('users')->where('email', $reg_email_0)->get();
  $is_email_registered = json_decode(json_encode($is_email_registered), true);

//var_dump($is_email_registered);
  if(!empty($is_email_registered[0]['id'])) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>111,'error_message'=>Lang::get('messages.welcome')),'status'=>'error')]);
  }




  $is_login_registered = DB::table('users')->where('login', $reg_login_0)->get();
  $is_login_registered = json_decode(json_encode($is_login_registered), true);

//var_dump($is_email_registered);
  if(!empty($is_login_registered[0]['id'])) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>111,'error_message'=>Lang::get('messages.welcome')),'status'=>'error')]);
  }

  $this->crypto = new Crypto;
  $password_hashing = $this->crypto->passwordHashing($reg_password_0);
  $hashed_password = $password_hashing['hashed_password'];  
  $salt = $password_hashing['salt'];

  if($reg_first_name_length_0 < 3) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>113,'error_message'=>trans('messages.short_firstname')),'status'=>'error')]);
  } else if($reg_first_name_length_0 > 70) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>114,'error_message'=>trans('messages.long_first_name')),'status'=>'error')]);
  }

  if($reg_last_name_length_0 < 3) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>115,'error_message'=>trans('messages.short_lastname')),'status'=>'error')]);
  } else if($reg_last_name_length_0 > 70) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>116,'error_message'=>trans('messages.long_lastname')),'status'=>'error')]);
  }


  if($reg_login_length_0 < 3) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>117,'error_message'=>trans('messages.short_login')),'status'=>'error')]);
  } else if($reg_login_length_0 > 70) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>118,'error_message'=>trans('messages.long_login')),'status'=>'error')]);

  }

  if($reg_email_length_0 < 3) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>119,'error_message'=>trans('messages.short_email')),'status'=>'error')]);
  } else if($reg_email_length_0 > 70) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>120,'error_message'=>trans('messages.long_email')),'status'=>'error')]);
  } else if(!filter_var($reg_email_0, FILTER_VALIDATE_EMAIL)) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>121,'error_message'=>trans('messages.incorrect_email')),'status'=>'error')]);
  }

  if($reg_password_length_0 < 3) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>122,'error_message'=>trans('messages.short_password')),'status'=>'error')]);
  } else if($reg_password_length_0 > 70) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>123,'error_message'=>trans('messages.long_password')),'status'=>'error')]);
  }
  $timestamp_registered = time();
  $reg_ip = $_SERVER['REMOTE_ADDR'];
  $reg_time = time();
  $user_hash = md5(time());

    $password_hashing = $this->crypto->passwordHashing($reg_password_0);
    $hashed_password = $password_hashing['hashed_password'];  
    $salt = $password_hashing['salt'];
$q = DB::table('users')->insertGetId(
array('id'=>NULL,
'first_name'=>$reg_first_name_0,
'last_name'=>$reg_last_name_0,
'email'=>$reg_email_0,
'hashed_password'=>$hashed_password,
'salt'=>$salt,
'time_reg'=>time(),

'ip_reg'=>$_SERVER['REMOTE_ADDR'],

'hash'=>md5(time()),

'token'=>md5(time()),

'big_photo'=>'',

'small_photo'=>'',

'time_birth'=>'',
'login'=>$reg_login_0,
'bio'=>''


));
//var_dump($q);
session(['user_id'=>$q]);
session(['user_first_name'=>$reg_first_name_0]);
session(['user_last_name'=>$reg_last_name_0]);
session(['user_login'=>$reg_login_0]);
session(['user_small_photo'=>'']);
session(['user_big_photo'=>'']);
session(['user_email'=>$reg_email_0]);
session(['user_bio'=>'']);
return redirect('/');
   // return view('photo.upload');
















    }

}