<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Brand;

class BrandController extends Controller
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
         $brand = Brand::orderBy('id', 'desc')->paginate(5);  //retrieve records in paginations format, 3 per page.

        //return view('locations.index')->with('locations', $loc);
        return view('brands.index')->with('brands', $brand);  
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
        return view('brands.create'); 
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
        $this->validate($request, ['brand'=>'required|max:255']);

        $brand = new Brand();
        $brand->brand = $request->brand;
        $brand->note = $request->note;
        $brand->create_user = Auth::user()->id;

        //if insert is successful then we want to redirect to view to show to the user
        if ($brand->save()){
            return redirect()->route('brands.index', $brand->id);
        }
        else {
            return redirect()->route('brands.create');
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
        $brand = Brand::findOrFail($id); //In case the id is not found

        //return the view with some info, first parameter is the name of the data
        //we want to refer to. Second parameter is the actual data we want to pass into
        return view('brands.show')->with('brand', $brand); 
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
        $brand = Brand::findOrFail($id); //In case the id is not found
        return view('brands.edit', compact('brand')); 
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
        $brand = Brand::findOrFail($id); //In case the id is not found
        $this->validate($request, ['brand'=>'required|max:255']);

        $brand->brand = $request->get('brand');
        $brand->note = $request->get('note'); 
        $brand->update_user = Auth::user()->id;
        //$brand->updated_at = now(); //update_at will be automatically updated with current datetime, no need to worry about it
        $brand->save();

        return redirect()->route('brands.index')->with('message', 'Brand Updated.');
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
        $brand = Brand::findOrFail($id); //In case the id is not found
        $brand->delete();

        return redirect()->route('brands.index')->with('message', 'Brand Deleted.');
    }
}
