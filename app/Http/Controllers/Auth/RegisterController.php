<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //register custom

    protected function register(Request $request){
         $this->validator($request->all())->validate();

         $user = new User();
         $user->name = $request->get('name');
         $user->email = $request->get('email');
         $user->password = $this->bcryptPassword($request->get('password'));

         $user->save();
         $role = Role::where('name','=','guest')->count();

         if($role == 1){
             $role = Role::where('name','=','guest')->first();
             $role->users()->save($user::find($user->id));
         }else{
             $role = new Role();
             $role->name = 'guest';
             $role->save();
             
             $role->users()->save($user::find($user->id));
         }
         Auth::guard()->login($user);

         return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected function bcryptPassword($password){
        return bcrypt($password);
    }
}
