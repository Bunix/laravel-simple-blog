<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Session;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Permission::with('roles')->get();

        return view('admin.Permission.index',['permissions'=>$p]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $this->authorize('create',Permission::class);
        $r = Role::all();
        return view('admin.permission.create',['roles'=>$r]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize('create',Permission::class);

        $p = new permission();
        $p->name = $request->get('name');
        $p->save();

        $roles = $request->input('roles');
       
        if(isset($roles)){
            if(is_array($roles)){

                foreach ($roles as $role) {
                   $r = Role::where('id','=',$role)->firstOrFail();

                   $p = Permission::where('name','=',$request->get('name'))->first();
                   $p->roles()->attach($r);
                }

            }else{
                   $r = Role::where('id','=',$roles)->firstOrFail();
      
                   $p = Permission::where('name','=',$request->get('name'))->first();
                   $p->roles()->attach($r);
            }
        }

        Session::flash('message', 'successful Insert!');
        Session::flash('type', 'success');

        return redirect()->route('permission.edit',['id'=>$p->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $p = Permission::with('roles')->findorFail($id);
        $this->authorize('view',$p);
        return view('admin.permission.show',['permission'=>$p]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $p = Permission::with('roles')->findorFail($id);
        $this->authorize('update',$p);
        $r = Role::all();
        return view('admin.permission.update',['permission'=>$p,'roles'=>$r]);
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
        $p = permission::with('roles')->findorFail($id);

        $this->authorize('update',$p);

        $p->name = $request->get('name');
        $p->save();

        //detach all roles
        foreach($p->roles as $r){
            $p->roles()->detach($r->id);
        }

        $roles = $request->input('roles');

        if(isset($roles)){
            if(is_array($roles)){

                foreach ($roles as $role) {
                   $r = Role::where('id','=',$role)->firstOrFail();

                   $p = Permission::where('name','=',$request->get('name'))->first();
                   $p->roles()->attach($r);
                }

            }else{
                   $r = Role::where('id','=',$roles)->firstOrFail();
      
                   $p = Permission::where('name','=',$request->get('name'))->first();
                   $p->roles()->attach($r);
            }
        }
        Session::flash('message', 'successful Insert!');
        Session::flash('type', 'success');

        return redirect()->route('permission.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Permission::find($id);

        $this->authorize('delete',$p);

        $p->delete();

        //detach all roles
        foreach($p->roles as $r){
            $p->roles()->detach($r->id);
        }

        Session::flash('message', 'successful Insert!');
        Session::flash('type', 'success');

        return redirect()->route('permission.index');
    }
}
