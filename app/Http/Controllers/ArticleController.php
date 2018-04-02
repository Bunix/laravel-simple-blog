<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Article;
use App\Category;
use App\Tag;
use Auth;
use Session;

class ArticleController extends Controller
{
    public function __construct(){
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $article = Article::with('author','comments','tags','categories','likes','dislikes')
         ->get();

        return view('article.index',['articles'=>$article]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        $this->authorize('create',Article::class);
        $categories = Category::all();
        $tags = Tag::all();

        return view('article.create',['categories'=>$categories,'tags'=>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize('create',Article::class);
        $article = new Article();
        $article->title = $request->get('title');
        $article->slug = str_slug($request->get('title'));
        $article->desc = $request->get('content');

        if($request->hasFile('featured_file') && $request->file('featured_file')->isValid()){

            $file = $request->featured_file;
            $ext = $file->extension();
            $name = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::putFileAs('public/post_gallary',$file,$name);
            $article->src = url('storage/post_gallary/'.$name);
        }
        
        $article->author()->associate(Auth::user());
        $article->save();

        $c = $request->input('categories');
        
        if(isset($c)){
            if(is_array($c)){

               foreach ($c as $j) {
               $k = Category::where('id','=',$j)->firstOrFail();

               $article = Article::find($article->id);
               $article->categories()->attach($k);
              } 
            }else{
               $k = Category::where('id','=',$j)->firstOrFail();

               $article = Article::find($article->id);
               $article->categories()->attach($k);
            }
        }

        $t = $request->input('tags');
        
        if(isset($t)){
            if(is_array($t)){

               foreach ($t as $j) {
               $k = Category::where('id','=',$j)->firstOrFail();

               $article = Article::find($article->id);
               $article->tags()->attach($k);
              } 
            }else{
               $k = Category::where('id','=',$j)->firstOrFail();

               $article = Article::find($article->id);
               $article->tags()->attach($k);
            }
        }

        Session::flash('message', 'successful Insert!');
        Session::flash('type', 'success');
       
        return redirect()->action('ArticleController@edit',['id'=>$article->id]);     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findorFail($id);
        $this->authorize('view',$article);

        return view('article.show',['article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $this->authorize('update',$article);

        $categories = Category::all();
        $tags = Tag::all();

        return view('article.update',['article'=>$article,'categories'=>$categories,'tags'=>$tags]);
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
        $article = Article::find($id);
        $this->authorize('update',$article);

        $article->title = $request->get('title');
        $article->slug = str_slug($request->get('title'));
        $article->src = $request->get('featured_file');
        $article->desc = $request->get('content');

        if($request->hasFile('featured_file') && $request->file('featured_file')->isValid()){

            $file = $request->featured_file;
            $ext = $file->extension();
            $name = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::putFileAs('public/post_gallary',$file,$name);
            $article->src = url('storage/post_gallary/'.$name);
        }

        $article->save();

        //detach all categories
        foreach($article->categories as $c){
            $article->categories()->detach($c->id);
        }

        $c = $request->input('categories');
        
        if(isset($c)){
            if(is_array($c)){

               foreach ($c as $j) {
               $k = Category::where('id','=',$j)->firstOrFail();

               $article = Article::find($article->id);
               $article->categories()->attach($k);
              } 
            }else{
               $k = Category::where('id','=',$c)->firstOrFail();

               $article = Article::find($article->id);
               $article->categories()->attach($k);
            }
        }

        //detach all tags
        foreach($article->tags as $t){
            $article->tags()->detach($t->id);
        }

        $t = $request->input('tags');
        
        if(isset($t)){
            if(is_array($t)){

               foreach ($t as $j) {
               $k = Tag::where('id','=',$j)->firstOrFail();

               $article = Article::find($article->id);
               $article->tags()->attach($k);
              } 
            }else{
               $k = Tag::where('id','=',$t)->firstOrFail();

               $article = Article::find($article->id);
               $article->tags()->attach($k);
            }
        }

        Session::flash('message', 'successful Update!');
        Session::flash('type', 'success');

        return redirect()->action('ArticleController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('delete',$article);

        foreach($article->categories as $c){
            $article->categories()->detach($c->id);
        }
        foreach($article->tags as $t){
            $article->tags()->detach($t->id);
        }

        $article->delete();

        Session::flash('message', 'successful Delete!');
        Session::flash('type', 'success');

        return redirect()->action('ArticleController@index');
    }
}
