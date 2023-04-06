<?php
namespace App\Http\Controllers;
use DB;

use Lang;
use Crypto;
class ArticleController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function getArticles()
    {
      $articles = DB::table('articles')->orderBy('id', 'DESC')->get();
      $articles = json_decode(json_encode($articles),true);
        return view('article.get_articles', ['articles'=>$articles]);

    }

    public function write()
    {
      $articles = DB::table('articles')->get();
      $articles = json_decode(json_encode($articles),true);
        return view('article.article');

    }
    public function get()
    {
      $articles = DB::table('articles')->where('id', $_GET['article_id'])->get();
      $articles = json_decode(json_encode($articles),true);
        return view('article.get_one_article', ['article'=>$articles]);

    }
    public function ajaxAddArticle()
    {//SELECT `id`, `title`, `text`, `time_created`, `owner_id`, `hash`, `is_deleted` FROM `articles` WHERE 1
      DB::table('articles')->insert(array(
'id'=>NULL, 
'title'=>$_POST['title'], 
'text'=>$_POST['text'], 
'time_created'=>time(), 
'owner_id'=>session('user_id'), 
'hash'=>md5(rand()), 
'is_deleted'=>'false'
      ));
        echo 'tet';

    }


}