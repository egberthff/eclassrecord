<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\College;
class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $model = College::where('status', 1)->get();
        $inactive = College::where('status', 0)->get();
        return view('admin.college.index', compact('model', 'inactive'));
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

        $validator = $request->validate([
            'name' => 'required', 'max:255'
        ]);

        $exist = College::where('name', $request->name)->first();

        if ($exist == null) {

            $model = new College;
            $model->name = $request->name;
            $model->description = $request->description;
            $model->dean = $request->dean;
            $model->save();

            Session::flash('Inserted');
        }else{
            Session::flash('Duplicate');
        }

        
        return redirect('college');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $college = College::find($id);
        if($college->status == 1){
            $college->status = 0;

            Session::flash('Archived');
        }else{
            $college->status = 1;

            Session::flash('Activated');
        }
        $college->save();
        return redirect('college');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $collection = College::find($id);
        $model = College::where('status', 1)->get();
        $inactive = College::where('status', 0)->get();
        return view('admin.college.edit', compact('model' , 'collection', 'inactive'));
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
        $validator = $request->validate([
            'name' => 'required', 'max:255',
        ]);

        $model = College::findOrFail($id);
        $model->name = $request->name;
        $model->description = $request->description;
        $model->dean = $request->dean;
        $model->save();

        Session::flash('Updated');
        
        return redirect('college');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function college_destroy()
    {
        //  $college = College::findOrFail($id);
        //  $college->delete();

        //  return redirect('college');
    }

    public function view_list(){

        $model = College::where('status', 1)->orderBy('name', 'desc')->get();

        return view('admin.college.view', compact('model'));
    }
}
