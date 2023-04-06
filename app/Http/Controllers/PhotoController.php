<?php
namespace App\Http\Controllers;
 use DB;

class PhotoController extends Controller
{



    public function uploadPhoto() {
return view('photo.upload_photo');

    }
    /**

     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show() {
    $photos = DB::table('photos')->orderBy('id', 'DESC')->where('is_deleted', '!=', 'true')->get();
    $photos = json_decode(json_encode($photos), true);
    $row1 = array();
    $result = array();

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
        return view('photo.photo', ['photos'=>$result ]);

    }




    public function showOnePhoto($photo_id) {
    $photos = DB::table('photos')->orderBy('id', 'DESC')->where('id', $photo_id)->get();
    $photos = json_decode(json_encode($photos), true);
    $row1 = array();
    $result = array();

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
        return view('photo.get_one_photo', ['photos'=>$result ]);

    }



}