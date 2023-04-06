<?php
Artisan::call('view:clear');
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function() {
	return redirect('/photo');
});

Route::post('/photo/ajax_upload', function () {
  $my_image = '/public/upload/c1/'.rand().'.jpg';
  $image_path = SITE_ROOT.$my_image;
  $tmp_name = $_FILES["file"]["tmp_name"];
  move_uploaded_file($tmp_name, $image_path);
  echo json_encode(array('big_photo_path'=>$my_image, 'small_photo_path'=>$my_image));
});

Route::get('/photo/upload', function() {
  return view('/photo/upload');
});

Route::get('/logout', function(Request $request){
  $data = $request->session()->all();
  Session::flush();
  return redirect('/');
});


Route::get('/id{profile_id}', 'App\Http\Controllers\ProfileController@show');
Route::get('/likes', 'App\Http\Controllers\LikesController@show');

Route::get('/likes/dis_likes', 'App\Http\Controllers\LikesController@showDisLikes');



Route::get('/reg', 'App\Http\Controllers\RegController@show');
Route::get('/search', 'App\Http\Controllers\SearchController@show');
Route::post('/reg', 'App\Http\Controllers\RegController@makeReg');


Route::get('/login', 'App\Http\Controllers\LoginController@show');


Route::post('/login', 'App\Http\Controllers\LoginController@show');


Route::get('/photo', 'App\Http\Controllers\PhotoController@show');





Route::get('/restore', 'App\Http\Controllers\RestoreController@showForm');
Route::get('/restore/by_email/{restore_token}', 'App\Http\Controllers\RestoreController@byEmail');
Route::get('/restore/change', 'App\Http\Controllers\RestoreController@change');



Route::post('/restore', 'App\Http\Controllers\RestoreController@showForm');
Route::post('/restore/by_email/{restore_token}', 'App\Http\Controllers\RestoreController@byEmail');
Route::post('/restore/change', 'App\Http\Controllers\RestoreController@change');




Route::get('/photo/upload_photo', 'App\Http\Controllers\PhotoController@uploadPhoto');

Route::get('/like/', 'App\Http\Controllers\LikeController@showLike');



Route::get('/like/dis_like', 'App\Http\Controllers\LikeController@showDisLike');





Route::post('/photo/upload_photo', 'App\Http\Controllers\PhotoController@uploadPhoto');
Route::get('/setting', 'App\Http\Controllers\SettingController@show');
Route::post('/setting', 'App\Http\Controllers\SettingController@show');
Route::get('/setting/change_photo', 'App\Http\Controllers\SettingController@changePhoto');
Route::post('/setting/change_photo', 'App\Http\Controllers\SettingController@changePhoto');
Route::get('/photo/ajax_add_like', function() {
  DB::table('likes')->insert(array(
'id'=>NULL,
'owner_id'=>session('user_id'),
'target_id'=>1,
'time_created'=>time(),
'ip_owner'=>$_SERVER['REMOTE_ADDR'],
'item_id'=>$_GET['item_id'],
'obj'=>'photo'


  ));

});

Route::get('/photo/ajax_remove_like', function() {
 //DB::table('likes')->where('owner_id', session('user_id'))->where('item_id',$_GET['item_id'])->delete();
 DB::table('likes')->where('item_id',$_GET['item_id'])->delete();
});

Route::get('/photo/ajax_add_dis_like', function() {/*
  DB::table('dis_likes')->insert(array(
'id'=>NULL,
'owner_id'=>session('user_id'),
'target_id'=>1,
'time_created'=>time(),
'ip_owner'=>$_SERVER['REMOTE_ADDR'],
'item_id'=>$_GET['item_id'],
'obj'=>'photo',
  ));*/
  DB::table('dis_likes')->insert(array(
'id'=>NULL,
'owner_id'=>session('user_id'),
'target_id'=>1,
'time_created'=>time(),
'ip_owner'=>$_SERVER['REMOTE_ADDR'],
'item_id'=>$_GET['item_id'],
'obj'=>'photo',
  ));
});
Route::get('/photo/ajax_remove_dis_like', function() {
  DB::table('dis_likes')->where('owner_id', session('user_id'))->where('item_id',$_GET['item_id'])->delete();
});
Route::post('/photo/save_photo', function () {

  DB::table('photos')->insert(array(
'id'=>NULL,
'owner_id'=>session('user_id'), 
'small_photo'=>$_POST['small_photo'],
'big_photo'=>$_POST['big_photo'],
'album_id'=>0, 
'time_created'=>time(),
'is_deleted'=>time(),
  'title'=>$_POST['title'],
  'text'=>$_POST['text']
  ));
});
Route::get('/photo/delete', function () {
DB::table('photos')->where('id', $_GET['item_id'])->update([
'is_deleted'=>'true'
]);
});

Route::get('/photo/un_delete', function () {
DB::table('photos')->where('id', $_GET['item_id'])->update([
'is_deleted'=>'false'
]);
});



Route::get('/photo/save_photo', function () {

  DB::table('photos')->insert(array(
'id'=>NULL,
'owner_id'=>session('user_id'), 
'small_photo'=>$_GET['small_photo'],
'big_photo'=>$_GET['big_photo'],
'album_id'=>0, 
'time_created'=>time(),
'is_deleted'=>time(),
  'title'=>$_GET['title'],
  'text'=>$_GET['text']

  ));
});



Route::get('/photo/ajax_un_follow', function () {
      DB::table('followers')->where('item_id',$_GET['item_id'])->delete();

});
Route::get('/photo/ajax_follow', function () {

      DB::table('followers')->insert(array(
        'id'=>NULL,
        'owner_id'=>session('user_id'),
        'target_id'=>2,
        'time_created'=>2,
        'item_id'=>$_GET['item_id']
      ));
});



Route::get('/food/{food_id}', function ($food_id) {


    $photos = DB::table('photos')->orderBy('id', 'DESC')->where('id', $food_id)->get();
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

  return view('/photo/get_food', ['photos'=>$result ]);
});