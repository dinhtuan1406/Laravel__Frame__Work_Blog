<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



//  you need to add this manual in visual studio code this is not automatic
use App\Http\Requests\CreatePost;
// you need to add this manual 
use App\Post;
// you need to add this manual 
use App\Comment;

use App\User;
// you need to add this manual 

use App\Http\Requests\UserUpdate;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('checkRole:admin');

    }

    public function dashboard(){

        return view('admin.dashboard');
    }

    public function comments(){

        $comments = Comment::all();
        return view('admin.comments',compact('comments'));
    }


    public function posts(){

        $posts = Post::all();
        return view('admin.posts',compact('posts'));
    }



    public function users(){

        $users = User::all();

        return view('admin.users',compact('users'));

    }



    public function postEditPost(CreatePost $request, $id){

        $post = Post::where('id',$id)->first();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();

        return back()->with('success','Post updated Successfully');
    }

    public function deletePost($id){

        $post = Post::where('id',$id)->first();
        $post->delete();
        
        return back();
    }


    public function postEdit($id){

        $post = Post::where('id',$id)->first();
        return view('admin.editPost',compact('post'));

    }

    public function deleteComment($id){

        $comment = Comment::where('id',$id)->first();
        $comment->delete();
       
        return back();

    }


    public function editUser($id){

        $user = User::where('id',$id)->first();
        return view('admin.editUser',compact('user'));

    }


    public function editUserPost(UserUpdate $request , $id){

        $user = User::where('id',$id)->first();
        $user->name = $request['name'];
        $user->email = $request['email'];


        if($request['author'] == 1){

            $user->author = true;
            
        } elseif($request['admin'] == 1){
            $user->admin = true;

        }

        $user->save();

        return back()->with('success','User updated successfully');

    }

}
