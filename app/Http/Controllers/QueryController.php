<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Video;

class QueryController extends Controller
{
    public function search(Request $req){
      $query = $req->input('query');

      $results = Article::where('title','LIKE','%'.$query.'%')
                        ->orWhere('desc','LIKE','%'.$query.'%')
                        ->get();
      
      return view('search',compact('results','query'));
    }
}
