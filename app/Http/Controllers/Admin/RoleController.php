<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::with('permissions')->get();

        return view('admin.role.index',['roles'=> $role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $this->authorize('create',Role::class);
        
        $p = Permission::all();
        return view('admin.role.create',['permissions'=>$p]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize('create',Role::class);

        $role = new Role();
        $role->name = $request->get('name');
        $role->save();

        $permissions = $request->input('permissions');
        
        if(isset($permissions)){
            if(is_array($permissions)){

               foreach ($permissions as $permission) {
               $p = Permission::where('id','=',$permission)->firstOrFail();

               $role = Role::where('name','=',$request->get('name'))->first();
               $role->permissions()->attach($p);
              } 
            }else{
               $p = Permission::where('id','=',$permissions)->firstOrFail();

               $role = Role::where('name','=',$request->get('name'))->first();
               $role->permissions()->attach($p);
            }
        }

        Session::flash('message', 'successful Insert!');
        Session::flash('type', 'success');

        return  redirect()->action('Admin\RoleController@edit',['id' => $role->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::with('permissions')->findorFail($id);
        $this->authorize('view',$role);
        return view('admin.role.show',['role'=>$role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->findorFail($id);
        $this->authorize('update',$role);
        $p = Permission::all();
        return view('admin.role.update',['role'=>$role,'permissions'=>$p]);
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
        $role = Role::with('permissions')->findorFail($id);
        $this->authorize('update',$role);
        $role->name = $request->get('name');
        $role->save();

        //detach all permissions
        foreach($role->permissions as $permission){
            $role->permissions()->detach($permission->id);
        }
        //attach new
        $permissions = $request->input('permissions');

        if(isset($permissions)){
            if(is_array($permissions)){

               foreach ($permissions as $permission) {
               $p = Permission::where('id','=',$permission)->firstOrFail();

               $role = Role::where('name','=',$request->get('name'))->first();
               $role->permissions()->attach($p);
              } 
            }else{
               $p = Permission::where('id','=',$permissions)->firstOrFail();

               $role = Role::where('name','=',$request->get('name'))->first();
               $role->permissions()->attach($p);
            }
        }

        Session::flash('message', 'successful update!');
        Session::flash('type', 'success');

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::with('permissions')->find($id);
        $this->authorize('delete',$role);
        $role->delete();
        //detach all permissions
        foreach($role->permissions as $permission){
            $role->permissions()->detach($permission->id);
        }

        Session::flash('message', 'successful Delete!');
        Session::flash('type', 'success');

        return redirect()->route('role.index');
    }
}
