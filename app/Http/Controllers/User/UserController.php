<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{



    public function userlogin(Request $request){

        if($request->isMethod('post')){
            $data = $request->input();
             if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect()->route('frontend');
            }else{
                //echo "failed"; die;
                return redirect('/user')->with('flash_message_error','Invalid Username or Password');
            }
        }
        
        return view('User.auth.login');
    }

    public function userDashboard()
    {
        $user = User::all();
        return view('User.user',compact('user'));
    }

    public function register(Request $request){

        if($request->isMethod('post')){
            // dd($request->all());
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> bcrypt($request->password),
            ]);

            if(Auth::attempt($request->only('email','password'))){
                return redirect()->route('userDashboard');
            }
        }
        
        
        return view('User.auth.register');
    }

    public function Userlogout(){
        Auth::logout();
    	return redirect()->route('userlogin');
    }


    public function user_edit()
    {
        $user = User::all();
        return view('User.edit_user',compact('user'));
    }

    public function user_update(Request $request, string $id){
        // dd($request->all());
        
        if($request->isMethod('post')){
            if($request->hasFile('image')){
                $image_tmp=$request->file('image');

                if($image_tmp->isValid()){
                    $image_name=$image_tmp->getClientOriginalName();
                    $extension=$image_tmp->getClientOriginalExtension();
                    $fileName=$image_name.'-'.rand(111,99999).'.'. $extension;
                    $image_path='assets/uploads/user'.'/'.$fileName;
                    Image::make($image_tmp)->resize(150,150)->save($image_path);       
                }
            }else{
                $image_path = '';
            }
            $user = User::find(Auth::user()->$id);
            Auth::user()->name = $request->name;
            Auth::user()->address = $request->address;
            Auth::user()->phone = $request->phone;
            Auth::user()->image = $image_path;
            Auth::user()->update();
        }
        return redirect()->route('userDashboard');
    }

    public function password(){
        return view('User.changepass');

    }

    public function changePassword(Request $request){
        $request->validate([
            'current_password' => ['required','string','min:4'],
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, Auth::user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Password Updated Successfully');

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }

}
