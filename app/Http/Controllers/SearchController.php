<?php

namespace App\Http\Controllers;
 use PDO;
 use DB;
class SearchController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show()
    {




  if(empty($_GET['q']) ) {




  $link = connectDatabase(); 
  $sql = 'SELECT `id`, `first_name`, `last_name`, `big_photo`, `small_photo`, `login`, `bio` FROM `users` ORDER BY `id` DESC';
  $is_email_exist = $link->prepare($sql);
  $is_email_exist->execute();
  $arr = array();
  while($row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC)) {

    $ress = DB::table('followers')->where('item_id' , $row1['id'])->where('owner_id' , session('user_id'))->get();
    $ress =  json_decode(json_encode($ress), true);
    
    $row1['is_i_follow'] = !empty($ress) ? true : false;
    $arr[] = $row1;
  }



  return view('search.search', ['result'=>$arr]);
  }


  $search_word = $_GET['q'];
  $link = connectDatabase(); 
  $search_word = explode(' ', $search_word);
  $sql = 'SELECT `id`, `first_name`, `last_name`, `small_photo`,`big_photo`, `login`, `bio` FROM `users` WHERE ';
  for($i=0;$i<count($search_word); $i++) {
    if($i == 0) {
      $sql .= ' `first_name` LIKE "%'.$search_word[$i].'%"';
    } else {
      $sql .= ' OR `last_name` LIKE "%'.$search_word[$i].'%"';
    }
  }
  $sql .= " ORDER BY `id` DESC";
  $is_email_exist = $link->prepare($sql);
  $is_email_exist->execute();
  $arr = array();
  while($row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC)) {

    $ress = DB::table('followers')->where('item_id' , $row1['id'])->where('owner_id' , session('user_id'))->get();
    $ress =  json_decode(json_encode($ress), true);
  
    $row1['is_i_follow'] = !empty($ress) ? true : false;
    $arr[] = $row1;
  }
  return view('search.search', ['result'=>$arr]);







    }
}