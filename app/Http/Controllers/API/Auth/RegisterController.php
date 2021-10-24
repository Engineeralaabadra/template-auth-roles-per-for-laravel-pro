<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use DB;
class RegisterController extends Controller
{
    public function authLogin(){
        return response()->json([
            'status'=>401,
            'message'=>'You havent authorization in this website'
        ]);
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request->all());
       // try{
            $rules= [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],//paasword and password_confirmation
                'organization' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'department_id' => 'required|numeric|max:255',
                'national_id' => 'required|numeric|max:255',
                'secret_code' => 'required|string|max:255',
                'image' => 'string|max:255',
                'phone_no1' => 'required|string|max:255|unique:users',
                'phone_no2' => 'string|max:255|unique:users',
                
            ];
            $data=$request->all();
            $validator=Validator::make($data,$rules);
            if($validator->fails())
            {
                return response()->json([
                    'status'=>400,
                    'message'=>$validator->errors()
                    ]);
            }else{
                $user=new User();
                $user->name=$request->name;
                $user->email=$request->email;
                $user->password=Hash::make($request->password);
                $user->organization=$request->organization;
                $user->address=$request->address;
                $user->department_id=$request->department_id;
                $user->national_id=$request->national_id;
                $user->secret_code=$request->secret_code;
                $user->image=$request->image;
                $user->phone_no1=$request->phone_no1;
                $user->phone_no2=$request->phone_no2;
                $user->save();
                DB::table('role_users')->insert(['role_id'=>2,'user_id'=>$user['id']]);//role id =2 -> user
                event(new Registered($user));
                return response()->json([
                    'status'=>200,
                    'message'=>'registered successfully, you can make login now'
                ]);
            }

        // }catch(\Exception $ex){
        //     return response()->json([
        //         'status'=>500,
        //         'message'=>'There is something wrong, please try again'
        //     ]);  
        // } 
    }
}
