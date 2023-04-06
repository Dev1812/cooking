<?php
 
namespace App\Http\Controllers;
use DB;
class ProfileController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($profile_id)
    {
    $photos = DB::table('photos')->where('owner_id', $profile_id)->where('is_deleted', '!=', 'true')->orderBy('id', 'DESC')->get();
    $photos = json_decode(json_encode($photos), true);
    $row1 = array();
    $result = array();




    $ress = DB::table('followers')->where('item_id' , $profile_id)->get();
    $ress =  json_decode(json_encode($ress), true);
  
    $is_i_follow =!empty($ress) ? true : false;



    foreach ($photos as $v) {
        $owner_info = DB::table('users')->where('id', $v['owner_id'])->get();
        $owner_info = json_decode(json_encode($owner_info), true);

      $row1['date_created'] = parseTimestamp($v['time_created']);

      $row1['data'] = $v;

      $row1['owner_info'] = $owner_info;

$likes_counter = DB::table('likes')->where('item_id', $v['id'])->count();
      $row1['likes_counter'] = $likes_counter;


$result2=DB::table('likes')->where('item_id', $v['id'])->where('owner_id', session('user_id'))->get();
$result2 = json_decode(json_encode($result2), true); 


      $row1['is_my_like'] = !!empty($result2[0]['id']);

$dis_likes_counter = DB::table('dis_likes')->where('item_id', $v['id'])->count();
      $row1['dis_likes_counter'] = $dis_likes_counter;



$result3=DB::table('dis_likes')->where('item_id', $v['id'])->where('owner_id', session('user_id'))->get();
$result3 = json_decode(json_encode($result3), true); 

      $row1['is_my_dis_like'] = !!empty($result3[0]['id']);


$result[]=$row1;
        # code...
    }


$owner_info = DB::table('users')->where('id', $profile_id)->get();
$owner_info = json_decode(json_encode($owner_info), true);
        return view('profile.profile', ['owner_info'=>$owner_info, 'profile_id'=>$profile_id, 'photos'=>$result , 'is_i_follow'=>$is_i_follow, 'profile_id'=>$profile_id, 'followers_counter'=>1, 'following_counter'=>1]);

    }
//SELECT `id`, `owner_id`, `target_id`, `time_created`, `item_id` FROM `followers` WHERE 1

    public function follow() {
      DB::table('followers')->insert(array(
        'id'=>NULL,
        'owner_id'=>session('user_id'),
        'target_id'=>2,
        'time_created'=>2,
        'item_id'=>$_GET['item_id'],
      ));
    }
    public function unFollow() {
      DB::table('followers')->where('owner_id', session('user_id'))->where('item_id', $_GET['item_id'])->delete();
    }
}