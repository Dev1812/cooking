<?php
 
namespace App\Http\Controllers;
use DB;
use Crypto;
use Lang;
class RestoreController extends Controller {

  public function showForm() {
  
    if(!empty($_POST['restore_submit'])) {
      DB::table('restore')->where('email', $_POST['restore_email'])->delete();
      $token =  md5(rand());
      DB::table('restore')->insert(array(
        'id'=>NULL,
        'owner_id'=>'0', 
        'email'=>$_POST['restore_email'], 
        'token'=>$token, 
        'time_created'=>time(),
        'owner_ip'=>$_SERVER['REMOTE_ADDR']));

      $to      = 'tets@sada.hjl';
      $subject = 'the subject';
      $message = $token;
      $headers = array('From' => 'tets@sada.hjl',
        'Reply-To' => 'tets@sada.hjl',
        'X-Mailer' => 'PHP/' . phpversion()
      );

      mail($to, $subject, $message, $headers);
    }
    return view('restore.restore');
  }



  public function byEmail($restore_token) {
    $rr = DB::table('restore')->where('token', $restore_token)->get();
    $rr = json_decode(json_encode($rr), true);
    if(empty($rr)) {
    	echo 'error';
    	exit;
    }
    session(['restore_email'=>$rr[0]['email']]);
    return redirect('/restore/change');
  }



public function change() {
  
  if(empty(session('restore_email'))) {
    redirect('/restore');
  }
if(!empty($_POST['password'])) {



$F = new Crypto;
$qr = $F->passwordHashing($_POST['password']);

DB::table('users')->where('email', session('restore_email'))->update(array(


'hashed_password'=>$qr['hashed_password'],
'salt'=>$qr['salt']


));

DB::table('restore')->where('email', session('restore_email'))->delete();

  \Session::flush();
}

  return view('/restore/change_password');
}


}


?>