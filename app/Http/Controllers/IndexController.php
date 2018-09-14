<?php

namespace App\Http\Controllers;
use\App\Setting;
use\App\Post;
use\App\Comment;
use \App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    public function setting()
    {
        return Setting::first();
    }
    public function index()
    {
        $setting=$this->setting();
        $posts=Post::where('status',1)->orderby('published_at','DESC')->limit(3)->get();
        return view('welcome',compact('setting','posts'));
    }

    public function blog()
    {
        $setting=$this->setting();
        $posts=Post::where('status',1)->orderBy('published_at','DESC')->paginate(4);
        return view('blog',compact('setting','posts'));
    }

    public function blogCatageroy($slug)
    {
      $setting=$this->setting();
      $category=Categories::where('slug',$slug)->first();

    //    $posts=DB::table('categories')
    //                ->join('posts','posts.category_id','=','categories.id')
    //                ->where('categories.slug',$slug)
    //                ->where('posts.status',1)
    //               ->orderBy('published_at','DESC')->get();
      $posts=$category->posts()->where('status',1)->orderBy('published_at','DESC')->paginate(4);
      return view('blog',compact('setting','posts'));

       }

       public function blogsearch(Request $request)
       {
             $setting=$this->setting();
             $posts = Post::search($request->get('q'))->orderBy('published_at','DESC')->paginate(4);
             return view('blog',compact('posts','setting'));
           // return $request->all();
       }


    public function show($slug)
    {

        $setting=$this->setting();
        $posts=Post::where('slug',$slug)->first();

        $prev=Post::where('id','<',$posts->id)
              ->latest('id')
              ->first();
        $next=Post::where('id','>',$posts->id)
              ->first();

        return view('show',compact('setting','posts','prev','next'));
    }
    public function comment(Request $request,$slug)
    {
        //return $request->all();
        $this->validate($request,[
            'name'  =>'required|min:3',
            'email' =>'required|email',
            'body'  =>'required|min:5'
        ]);

        $post=Post::where('slug',$slug)->first();
        $request['post_id']=$post->id;
        $request['status']=0;
        Comment::create($request->all());
        return redirect()->back();
    }
}
