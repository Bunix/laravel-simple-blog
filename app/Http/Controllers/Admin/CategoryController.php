<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c = Category::all();

        return view('admin.category.index',['categories'=>$c]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $this->authorize('create',Category::class);
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize('create',Category::class);

        $c = new Category();
        $c->name = $request->get('name');
        $c->save();

        Session::flash('message', 'successful Insert!');
        Session::flash('type', 'success');

        return redirect()->action('Admin\CategoryController@edit',['id'=>$c->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $c = Category::findorFail($id);
        $this->authorize('view',$c);

        return view('admin.category.show',['category'=>$c]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $c = Category::find($id);
        $this->authorize('update',$c);
        return view('admin.category.update',['category'=> $c]);

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
        $c = Category::find($id);
        $this->authorize('update',$c);
        $c->name = $request->get('name');
        $c->save();

        Session::flash('message', 'successful Update!');
        Session::flash('type', 'success');

        return redirect()->action('Admin\CategoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $c = Category::find($id);
        $this->authorize('delete',$c);
        $c->delete();

        Session::flash('message', 'successful Delete!');
        Session::flash('type', 'success');

        return redirect()->action('Admin\CategoryController@index');
    }
}
