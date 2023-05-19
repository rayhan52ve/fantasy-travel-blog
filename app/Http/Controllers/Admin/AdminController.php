<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Menu;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    
    public function profile()
    {
        $admin = Admin::first();
        return view('Admin.Profile.profile',compact('admin'));
    }

    public function profile_edit()
    {
        $admin = Admin::first();
        return view('Admin.Profile.edit_profile',compact('admin'));
    }

    public function profile_update(Request $request){
        // dd($request->all());
        
        if($request->isMethod('post')){
            if($request->hasFile('image')){
                $image_tmp=$request->file('image');

                if($image_tmp->isValid()){
                    $image_name=$image_tmp->getClientOriginalName();
                    $extension=$image_tmp->getClientOriginalExtension();
                    $fileName=$image_name.'-'.rand(111,99999).'.'. $extension;
                    $image_path='assets/uploads/profile'.'/'.$fileName;
                    Image::make($image_tmp)->resize(150,150)->save($image_path);       
                }
            }else{
                $image_path = '';
            }
            $admin = Admin::first();
            $admin->name = $request->name;
            $admin->address = $request->address;
            $admin->phone = $request->phone;
            $admin->image = $image_path;
            $admin->update();
        }
        return redirect()->route('profile');
    }

   
    public function login(Request $request){

        if(Auth::guard('admin')->check()){
            return redirect('admin/dashboard');
        }else{
            if($request->isMethod('post')){
                $data = $request->input();
                 if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    // dd("test");
                    return redirect()->route('frontend');
                }else{
                    //echo "failed"; die;
                    return redirect()->route('login')->with('flash_message_error','Invalid Username or Password');
                }
            }
        }
        
        return view('Admin.auth.login');
    }

    public function dashboard(){

        $admin = Admin::first();
        $usercount = User::count();
        $postcount = Post::count();
        $categorycount = Category::count();
        $tagcount = Tag::count();
        $menucount = Menu::count();
        $commentcount = Comment::count();
        // dd($admin);
        return view('Admin.dashboard',compact('admin','usercount','postcount','categorycount','tagcount','menucount','commentcount'));
    }


    public function logout(){
        Auth::guard('admin')->logout();
    	return redirect()->route('login');
    }
    
   



}
