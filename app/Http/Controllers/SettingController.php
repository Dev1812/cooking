<?php
 
namespace App\Http\Controllers;
use DB;
class SettingController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show()
    {
        if(!empty($_POST['setting_submit'])) {
           DB::table('users')->where('id', session('user_id'))->update(array(
'first_name'=>$_POST['setting_first_name'],
'last_name'=>$_POST['setting_last_name'],
'login'=>$_POST['setting_login'],
'email'=>$_POST['setting_email'],
'bio'=>$_POST['setting_bio']

           ));
        session(['user_first_name'=>$_POST['setting_first_name']]);
        session(['user_last_name'=>$_POST['setting_last_name']]);
        }
        $user_info = DB::table('users')->where('id', session('user_id'))->get();
        $user_info = json_decode(json_encode($user_info), true);
        return view('setting.setting_info', ['user_info'=>$user_info]);

    }

    public function changePhoto()
    {
        $user_info = DB::table('users')->where('id', session('user_id'))->get();
        $user_info = json_decode(json_encode($user_info), true);
        if(!empty($_GET['big_photo'])) {



        session(['user_small_photo'=>$_GET['big_photo']]);
        session(['user_big_photo'=>$_GET['big_photo']]);
        DB::table('users')->where('id', session('user_id'))->update([
'small_photo'=>$_GET['big_photo'],

'big_photo'=>$_GET['big_photo']

        ]);














        } else {
        return view('setting.change_photo', ['user_info'=>$user_info]);

        }

    }


    
}