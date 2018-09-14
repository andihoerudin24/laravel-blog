<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Comment;
use Yajra\Datatables\Datatables;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
         $this->middleware('role:admin');
    }

    public function index()
    {
        return view('admin.comment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments=Comment::findOrFail($id);
        return view('admin.comment.show',compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $comments=DB::table('comments')->where('id',$id)->first();
       return view('admin.comment.edit',compact('comments'));
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
        $comments=[
            'status'=>$request->status
        ];
          DB::table('comments')
              ->where('id',$id)
              ->update($comments);
          return redirect()->route('admin.comment.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('comments')
                ->where('id',$id)
                ->delete();
       return redirect()->route('admin.comment.index');
    }
    public function dataTable()
    {
         $comments=Comment::query();
         return dataTables::of($comments)
           ->addColumn('comment',function($comments){
               return substr($comments->body,0,30);
           })
           ->addColumn('post',function($comments){
               return substr($comments->post->title,0,30);
           })
           ->addIndexColumn()
           ->addColumn('status',function($comments){
            return $comments->status == 1 ? 'Publish' : 'Hide';
        })
           ->addColumn('action',function($comments){
               return view('layouts.admin.partials._action',[
                   'model'=>$comments,
                   'show_url'=>route('admin.comment.show',$comments->id),
                   'edit_url'=>route('admin.comment.edit',$comments->id),
                   'delete_url'=>route('admin.comment.destroy',$comments->id),
               ]);
           })
           ->rawColumns(['action'])
           ->make(true);
    }
}
