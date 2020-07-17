<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Order by will display the latest location entries first, in desc order
        //$brand = Brand::all();  //retrieve all records

        //Order by will display the latest location entries first, in desc order
        $category = Category::orderBy('id', 'desc')->paginate(5);  //retrieve records in paginations format, 3 per page.

        //return view('locations.index')->with('locations', $loc);
        return view('categories.index')->with('categories', $category);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //go to the view folder and look for locations folder and then
        //a file named create.blade.php
        return view('categories.create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the form date, and make this field required and set up max length to 255 varchar
        $this->validate($request, ['category'=>'required|max:255']);

        //$user = auth()->user();
        $category = new Category();
        $category->category = $request->category;
        $category->note = $request->note;
        //$loc->create_user = $user->name;

        //if insert is successful then we want to redirect to view to show to the user
        if ($category->save()){
            return redirect()->route('categories.index', $category->id);
        }
        else {
            return redirect()->route('categories.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //use the model to get 1 record from the database
        //show the view and pass the record to the view
        $category = Category::findOrFail($id); //In case the id is not found

        //return the view with some info, first parameter is the name of the data
        //we want to refer to. Second parameter is the actual data we want to pass into
        return view('categories.show')->with('category', $category); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
