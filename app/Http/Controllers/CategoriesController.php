<?php

namespace App\Http\Controllers;
use App\Categories;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
class CategoriesController extends Controller
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
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|string|min:5|unique:categories',
        ]);
        $request['slug']=str_slug($request->get('title'),'-');
        Categories::create($request->all());
        return redirect()->route('admin.categories.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show=Categories::findOrfail($id);
        return view('admin.categories.show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Categories::findOrfail($id);
        return view('admin.categories.edit',compact('edit'));
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
        $this->validate($request,[
            'title'=>'required|string|min:5|unique:categories,title,'.$id
        ]);
        $request['slug']=str_slug($request->get('title'),'-');
        $categorie=Categories::findOrfail($id);
        $categorie->update($request->all());
        return redirect()->route('admin.categories.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Categories::destroy($id)) return redirect()->back();
        return redirect()->route('admin.categories.index');

    }

    public function dataTable()
    {
        $categorie=Categories::query();
        return Datatables::of($categorie)
        ->addColumn('action',function($categorie){
            return view('layouts.admin.partials._action',[
                'show_url'   =>route('admin.categories.show',$categorie->id),
                'model'      =>$categorie,
                'edit_url'   =>route('admin.categories.edit',$categorie->id),
                'delete_url' =>route('admin.categories.destroy',$categorie->id)
            ]);
     })
     ->rawColumns(['action'])
     ->make(true);
    }

}
