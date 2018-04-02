<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Video;
use App\Tag;
use App\Category;
use App\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $articles = Article::with('author','categories','tags','likes','dislikes','comments')->get();
        $videos = Video::with('author','categories','tags','likes','dislikes','comments')->get();
        $tags = Tag::all();
        $categories = Category::all();
        $posts = $articles->merge($videos);
       
        return view('index',['articles'=>$articles,'videos'=>$videos,'tags'=>$tags,'categories'=>$categories]);
    }


    public function showPost($id){
        
        $article = Article::findOrFail($id);
        $categories = $article->categories()->get();

        return view('comment',['article'=>$article,'categories'=>$categories]);
    }

    public function showComment($id){
        
        $comment = Comment::findOrFail($id);

        return view('reply',['comment'=>$comment]);
    }
}
