<?php
namespace App\Http\Controllers;
 use DB;

class LikeController extends Controller
{



    public function showLike() {

    $photos = DB::table('likes')->orderBy('id', 'DESC')->where('owner_id', session('user_id'))->get();
    $photos = json_decode(json_encode($photos), true);
    $row1 = array();
    $result = array();

    foreach ($photos as $v) {
      $qwe = DB::table('photos')->where('id', $v['item_id'])->get();
      $qwe = json_decode(json_encode($qwe), true);

$row1['data'] = $qwe;

      $row1['date_created'] = parseTimestamp($v['time_created']);

$likes_counter = DB::table('likes')->where('item_id',   $v['item_id'])->count();
      $row1['likes_counter'] = $likes_counter;

        $owner_info = DB::table('users')->where('id', $v['owner_id'])->get();
        $owner_info = json_decode(json_encode($owner_info), true);

      $row1['owner_info'] = $owner_info;
$row1['id']=$v['item_id'];

$result[] = $row1;
      //$data
        # code...
    }
$likes_counter = DB::table('likes')->where('owner_id', session('user_id'))->count();
return view('like.like', ['photos'=>$result, 'likes_counter'=>$likes_counter]);

    }






























































    public function showDisLike() {

    $photos = DB::table('dis_likes')->orderBy('id', 'DESC')->where('owner_id', session('user_id'))->get();
    $photos = json_decode(json_encode($photos), true);
    $row1 = array();
    $result = array();

    foreach ($photos as $v) {
      $qwe = DB::table('photos')->where('id', $v['item_id'])->get();
      $qwe = json_decode(json_encode($qwe), true);

$row1['data'] = $qwe;

      $row1['date_created'] = parseTimestamp($row1['data'][0]['time_created']);

$likes_counter = DB::table('dis_likes')->where('item_id',   $v['item_id'])->count();
      $row1['likes_counter'] = $likes_counter;

        $owner_info = DB::table('users')->where('id', $v['owner_id'])->get();
        $owner_info = json_decode(json_encode($owner_info), true);

      $row1['owner_info'] = $owner_info;
$row1['id']=$v['item_id'];

$result[] = $row1;
      //$data
        # code...
    }
$likes_counter = DB::table('dis_likes')->where('owner_id', session('user_id'))->count();
return view('like.dis_like', ['photos'=>$result, 'likes_counter'=>$likes_counter]);

    }



























































    /**

     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show() {
    $photos = DB::table('likes')->orderBy('id', 'DESC')->where('owner_id', session('user_id'))->get();
    $photos = json_decode(json_encode($photos), true);
$result = array();
$qwe = array();
    foreach ($photos as $v) {

      $qwe = DB::table('photos')->where('id', $v['item_id'])->get();


      $qwe['data'] = json_decode(json_encode($qwe), true);





$likes_counter = DB::table('likes')->where('item_id', $v['item_id'])->count();
      $qwe['likes_counter'] = $likes_counter;



$dis_likes_counter = DB::table('dis_likes')->where('item_id', $v['item_id'])->count();
      $qwe['dis_likes_counter'] = $dis_likes_counter;












      $result[]=$qwe;
    }
   //   var_dump($result);
        return view('likes.likes', ['photos'=>$result ]);
      }

  
}