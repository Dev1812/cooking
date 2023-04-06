<?php
namespace App\Http\Controllers;
use DB;

use Lang;
use Crypto;
class LoginController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function  login()
    {
        return view('login.login');

    }
    public function show()
    {















  if(isUserAuth()) {
    //return redirect('/feed');
  }
  if(empty($_POST['login_submit_0'])) {
    return view('login.login');
  }

  $login_email_0 = $_POST['login_email_0'];
  $login_password_0 = $_POST['login_password_0'];

  $login_email_length_0 = mb_strlen($login_email_0);
  $login_password_length_0 = mb_strlen($login_password_0);
    
  $is_email_loginistered = \DB::table('users')->where('email', $login_email_0)->get();
  $is_email_loginistered = json_decode(json_encode($is_email_loginistered), true);

//var_dump($is_email_loginistered);
  if(!empty($is_email_loginistered[0]['id'])) {
    //return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>111,'error_message'=>Lang::get('messages.welcome')),'status'=>'error')]);
  }





  $this->crypto = new \Crypto;
  $password_hashing = $this->crypto->passwordHashing($login_password_0);
  $hashed_password = $password_hashing['hashed_password'];  
  $salt = $password_hashing['salt'];



  if($login_email_length_0 < 3) {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>119,'error_message'=>trans('messages.short_email')),'status'=>'error')]);
  } else if($login_email_length_0 > 70) {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>120,'error_message'=>trans('messages.long_email')),'status'=>'error')]);
  } else if(!filter_var($login_email_0, FILTER_VALIDATE_EMAIL)) {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>121,'error_message'=>trans('messages.incorrect_email')),'status'=>'error')]);
  }

  if($login_password_length_0 < 3) {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>122,'error_message'=>trans('messages.short_password')),'status'=>'error')]);
  } else if($login_password_length_0 > 70) {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>123,'error_message'=>trans('messages.long_password')),'status'=>'error')]);
  }
$get = DB::table('users')->where('email', $login_email_0)->get();

$get = json_decode(json_encode($get), true);
if(!$get) {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>123,'error_message'=>trans('messages.long_password')),'status'=>'error')]);    exit;
}$this->crypto = new Crypto;
var_dump($get[0]);
if($this->crypto->checkPassword($get[0]['hashed_password'], $login_password_0, $get[0]['salt'])) {
echo 'sdicc';


session(['user_id'=>$get[0]['id']]);
session(['user_first_name'=>$get[0]['first_name']]);
session(['user_last_name'=>$get[0]['first_name']]);
session(['user_login'=>$get[0]['first_name']]);/*
session(['user_small_photo'=>'']);
session(['user_big_photo'=>'']);
session(['user_email'=>$login_email_0]);
session(['user_bio'=>''])*/
return redirect('/');exit;
}
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>123,'error_message'=>trans('messages.long_password')),'status'=>'error')]);
  
  /*
  $timestamp_loginistered = time();
  $login_ip = $_SERVER['REMOTE_ADDR'];
  $login_time = time();
  $user_hash = md5(time());

    $password_hashing = $this->crypto->passwordHashing($login_password_0);
    $hashed_password = $password_hashing['hashed_password'];  
    $salt = $password_hashing['salt'];
var_dump($q);
session(['user_id'=>$q]);
session(['user_first_name'=>$login_first_name_0]);
session(['user_last_name'=>$login_last_name_0]);
session(['user_login'=>$login_login_0]);
session(['user_small_photo'=>'']);
session(['user_big_photo'=>'']);
session(['user_email'=>$login_email_0]);
session(['user_bio'=>'']);*/

    }

}