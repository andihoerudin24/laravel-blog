<?php

namespace App\Http\Controllers;
use App\Post;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Auth;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('role:admin',['only'=>['destroy']]);
         $this->middleware('role:author,admin',
             ['only'=>[
                 'index','create','store','show','edit','update','delete'
                   ]
            ]);
    }

    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|string|min:5',
            'body' => 'required|min:20',
            'status' => 'required',
            'published_at' => 'required'
        ]);
        $request['slug'] = str_slug($request->get('title'), '-');
        $request['user_id'] = $request->user()->id;
        //($request->all());
        Post::create($request->all());
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::findOrFail($id);
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        if(Auth::user()->role=='admin' || Auth::user()->id == $post->user_id ){
            return view('admin.posts.edit',compact('post'));
        }
       return abort(401);

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
        $post=Post::findorFail($id);

        if(Auth::user()->role=='admin' || Auth::user()->id == $post->user_id ){
            $this->validate($request, [
                'category_id' => 'required',
                'title'=>'required|string|min:5|unique:posts,title,'.$id,
                'body' => 'required|min:20',
                'status' => 'required',
                'published_at' => 'required'
            ]);
            $request['slug']=str_slug($request->get('title'), '-');

            $post->update($request->all());
            return redirect()->route('admin.posts.index');
        }
        return abort(401);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id);
        if(Auth::user()->role=='admin' || Auth::user()->id == $post->user_id ){
            if(!Post::destroy($id)) return redirect()->back();
            return redirect()->route('admin.posts.index');
        }
        return abort(401);


    }

    public function dataTable()
    {
        $posts=Post::query();
        return dataTables::of($posts)
        ->addColumn('author',function($posts){
            return $posts->user->name;
        })
        ->addIndexColumn()
        ->addColumn('categories',function($posts){
            return $posts->category->title;
        })
        ->addColumn('action', function ($posts) {
        return view('layouts.admin.partials._action',[
            'model'    =>$posts,
            'show_url' =>  route('admin.posts.show',$posts->id),
            'edit_url'  => route('admin.posts.edit',$posts->id),
            'delete_url'=> route('admin.posts.destroy',$posts->id)
        ]);
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
