<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use  App\Video;
use App\Tag;
use App\Category;
use Auth;
use Session;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = Video::with('author','comments','tags','categories','likes','dislikes')->get();

        return view('post.index',['posts'=> $video]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $this->authorize('create',Video::class);
        $tags  = Tag::all();
        $categories  = Category::all();

        return view('post.create',['tags'=>$tags,'categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Video::class);
        $video = new Video();
        $video->title = $request->get('title');
        $video->slug = str_slug($request->get('title'));
        $video ->desc = $request->get('content');

        if($request->hasFile('featured_file') && $request->file('featured_file')->isValid()){

            $file = $request->featured_file;
            $ext = $file->extension();
            $name = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::putFileAs('public/post_videos',$file,$name);
            $video->link = url('storage/post_videos/'.$name);
        }
        
        $video->author()->associate(Auth::user());
        $video->save();

        $c = $request->input('categories');
        
        if(isset($c)){
            if(is_array($c)){

               foreach ($c as $j) {
               $k = Category::where('id','=',$j)->firstOrFail();

               $video = Video::find($video->id);
               $video->categories()->attach($k);
              } 
            }else{
               $k = Category::where('id','=',$j)->firstOrFail();

               $video = Video::find($video->id);
               $video->categories()->attach($k);
            }
        }
        $t = $request->input('tags');
        
        if(isset($t)){
            if(is_array($t)){

               foreach ($t as $j) {
               $k = Tag::where('id','=',$j)->firstOrFail();

               $video = Video::find($video->id);
               $video->tags()->attach($k);
              } 
            }else{
               $k = Tag::where('id','=',$t)->firstOrFail();

               $video = Video::find($video->id);
               $video->tags()->attach($k);
            }
        }

        Session::flash('message', 'successful Insert!');
        Session::flash('type', 'success');
        
        return redirect()->route('post.edit',['id'=>$video->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::findOrFail($id);
        $this->authorize('view',$video);

        return view('post.show',['post'=>$video]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $this->authorize('update',$video);

        $tags  = Tag::all();
        $categories  = Category::all();

        return view('post.update',['post'=>$video,'categories'=>$categories,'tags'=>$tags]);
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
        $video = Video::find($id);
        $this->authorize('update',$video);

        $video->title = $request->get('title');
        $video->slug = str_slug($request->get('title'));
        $video->link = $request->get('link');
        $video->desc = $request->get('content');

        if($request->hasFile('featured_file') && $request->file('featured_file')->isValid()){

            $file = $request->featured_file;
            $ext = $file->extension();
            $name = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::putFileAs('public/post_videos',$file,$name);
            $video->link = url('storage/post_videos/'.$name);
        }

        $video->save();

        //detach all categories
        foreach($video->categories as $c){
            $video->categories()->detach($c->id);
        }

        $c = $request->input('categories');
        
        if(isset($c)){
            if(is_array($c)){

               foreach ($c as $j) {
               $k = Category::where('id','=',$j)->firstOrFail();

               $video = Video::find($video->id);
               $video->categories()->attach($k);
              } 
            }else{
               $k = Category::where('id','=',$c)->firstOrFail();

               $video = Video::find($video->id);
               $video->categories()->attach($k);
            }
        }

        //detach all tags
        foreach($video->tags as $t){
            $video->tags()->detach($t->id);
        }

        $t = $request->input('tags');
        
        if(isset($t)){
            if(is_array($t)){

               foreach ($t as $j) {
               $k = Tag::where('id','=',$j)->firstOrFail();

               $video = Video::find($video->id);
               $video->tags()->attach($k);
              } 
            }else{
               $k = Tag::where('id','=',$t)->firstOrFail();

               $video = Video::find($video->id);
               $video->tags()->attach($k);
            }
        }

        Session::flash('message', 'successful Update!');
        Session::flash('type', 'success');

        return redirect()->route('post.edit',['id'=>$video->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $this->authorize('delete',$video);

        foreach($video->categories as $c){
            $video->categories()->detach($c->id);
        }
        foreach($video->tags as $t){
            $video->tags()->detach($t->id);
        }

        $video->delete();

        Session::flash('message', 'successful Delete!');
        Session::flash('type', 'success');

        return redirect()->route('post.index',['posts'=>Video::all()]);
    }
}
