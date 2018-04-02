<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\like;
use App\Dislike;
use Auth;
use App\Article;
use App\Video;
use App\Comment;
use App\Reply;

class LikeController extends Controller
{   


    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $like = Like::with('user','likeable')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $likeable = $request->get('type');
        $user = Auth::user()->id;



        switch ($likeable) {
            case 'article':
                $like = $this->checkLike($user,'App\Article',$request->get('type_id'));
                if($like){
                    return response()->json(['msg','failed,liked'], 200);
                    exit;
                }
                $d = $this->checkDislike($user,'App\Article',$request->get('type_id'));
                if($d){
                    $this->dropdislike($user,'App\Article',$request->get('type_id'));
                }
                
                $article = Article::findOrFail($request->get('type_id'));
                $article->likes()->create([
                           'user_id'=> $user,
                ]);
                $article->save();
                break;
            case 'comment':
                $like = $this->checkLike($user,'App\Comment',$request->get('type_id'));
                 if($like){
                    return response()->json(['msg','failed,liked'], 200);
                    exit;
                }
                $d = $this->checkDislike($user,'App\Comment',$request->get('type_id'));
                if($d){
                    $this->dropdislike($user,'App\Comment',$request->get('type_id'));
                }

                $comment = Comment::findOrFail($request->get('type_id'));
                $comment->likes()->create([
                           'user_id'=> $user,
                ]);
                $comment->save();
                break;

            case 'reply':
                $like = $this->checkLike($user,'App\Reply',$request->get('type_id'));
                if($like){
                    return response()->json(['msg','failed,liked'], 200);
                    exit;
                }
                $d = $this->checkDislike($user,'App\Reply',$request->get('type_id'));
                if($d){
                    $this->dropdislike($user,'App\Reply',$request->get('type_id'));
                }

                $reply = Reply::findOrFail($request->get('type_id'));
                $reply->likes()->create([
                           'user_id'=> $user,
                ]);
                $reply->save();
                break;
            case 'video':
                $like = $this->checkLike($user,'App\Video',$request->get('type_id'));
                if($like){
                    return response()->json(['msg','failed,liked'], 200);
                    exit;
                }
                $d = $this->checkDislike($user,'App\Video',$request->get('type_id'));
                if($d){
                    $this->dropdislike($user,'App\Video',$request->get('type_id'));
                }

                $video = Video::findOrFail($request->get('type_id'));
                $video->likes()->create([
                           'user_id'=> $user,
                ]);
                $video->save();
                break;
            
            default:
                return response()->json(['msg','failed cant like'], 200); 
                break;
        }
        return response()->json(['msg','success'], 200); 
    }

    public function checkLike($user,$type,$type_id){
        $liked = Like::where('user_id','=',$user)
                 ->where('likeable_type','=',$type)
                 ->where('likeable_id','=',$type_id)
                 ->count() == 1;
        if($liked){
            return true;
        }
        return false;
    }
    public function checkDislike($user,$type,$type_id){
        $disliked = Dislike::where('user_id','=',$user)
                 ->where('dislikeable_type','=',$type)
                 ->where('dislikeable_id','=',$type_id)
                 ->count() == 1;
        if($disliked){
            return true;
        }
        return false;
    }

    public function dropdislike($user,$type,$type_id){
        $like = Dislike::where('user_id','=',$user)
                      ->where('dislikeable_type','=',$type)
                      ->where('dislikeable_id','=',$type_id)
                      ->first();
        $like->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
