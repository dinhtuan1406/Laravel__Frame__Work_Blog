<?php

namespace App\Http\Controllers;
//  you need to add this manual in visual studio code this is not automatic
use App\Http\Requests\UserUpdate;
//  you need to add this manual in visual studio code this is not automatic
use App\Comment;
use Illuminate\Http\Request;
// you need to add this manual in visual studio code this is not automatic
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //

    public function dashboard(){
        return view('user.dashboards');
    }

    public function comments(){
        return view('user.comments');
    }


    public function profile(){
        return view('user.profile');
    }


    public function ProfilePost(UserUpdate $request){
        
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        if($request['password'] !=""){
            if(!(Hash::check($request['password'],Auth::user()->password))){
                return redirect()->back()-with('error','Your current password does not match with the password you provided');
            }
        }

       return back();
    }

    public function deleComment($id){

        $comment = Comment::where('id',$id)->where('user_id',Auth::id())->delete();
       
        return back();
    }
}