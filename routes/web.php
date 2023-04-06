<?php
Artisan::call('view:clear');
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/reg', 'App\Http\Controllers\RegController@show');
Route::post('/reg', 'App\Http\Controllers\RegController@makeReg');


Route::get('/', function () {
    return redirect('/photo');
});
Route::get('/login', function () {
    return view('login.login');
});



Route::get('/id{profile_id}', 'App\Http\Controllers\ProfileController@show');


Route::get('/photo/upload_photo', function () {
    return view('photo.upload_photo');
});

Route::get('/search', 'App\Http\Controllers\SearchController@show');


Route::get('/setting', 'App\Http\Controllers\SettingController@show');


Route::post('/setting', 'App\Http\Controllers\SettingController@show');



Route::post('/setting/change_photo', 'App\Http\Controllers\SettingController@changePhoto');



Route::get('/setting/change_photo', 'App\Http\Controllers\SettingController@changePhoto');





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
  'text'=>'no'
  ));
});

Route::get('/restore', function () {
return view('restore.restore');
});

Route::get('/photo/save_photo', function () {

  DB::table('photos')->insert(array(
'id'=>NULL,
'owner_id'=>session('user_id'), 
'small_photo'=>$_GET['big_photo'],
'big_photo'=>$_GET['big_photo'],
'album_id'=>0, 
'time_created'=>time(),
'is_deleted'=>time(),
  'title'=>$_GET['title'],
  'text'=>'no'
  ));
});

Route::post('/photo/ajax_upload', function () {
  $my_image = '/public/upload/c1/'.rand().'.jpg';
  $image_path = SITE_ROOT.$my_image;
  $tmp_name = $_FILES["file"]["tmp_name"];
  move_uploaded_file($tmp_name, $image_path);
  echo json_encode(array('big_photo_path'=>$my_image, 'small_photo_path'=>$my_image));
});
Route::get('/like', 'App\Http\Controllers\LikeController@show');


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
 DB::table('likes')->where('item_id',$_GET['item_id'])->delete();
});





Route::get('/like', 'App\Http\Controllers\LikeController@show');




Route::get('/logout', function(Request $request){
  $data = $request->session()->all();
  Session::flush();
  return redirect('/');
});



Route::get('/photo/delete_photo', function() {
  DB::table('photos')->where('id', $_GET['item_id'])->update(array('is_deleted'=>'true'));
});
Route::get('/photo/un_delete_photo', function() {
  DB::table('photos')->where('id', $_GET['item_id'])->update(array('is_deleted'=>'false'));
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