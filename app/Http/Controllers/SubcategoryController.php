<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //go to the model and get a group of records
        //return the view, and pass in the group of records to loop through
        //$sublocation = Sublocation::all();  //retrieve all records

        //$loc = Location::paginate(3); this is the default pagination, order in ascending order

        //Order by will display the latest location entries first, in desc order
        $subcategory = Subcategory::orderBy('id', 'desc')->paginate(6);  //retrieve records in paginations format, 3 per page.

        //return view('locations.index')->with('locations', $loc);
        return view('subcategories.index')->with('subcategories', $subcategory);
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
        //return view('subcategories.create');  

        //$categories = Category::all();

        //Order by will display the latest location entries first, in desc order
        $categories = Category::orderBy('id', 'desc')->paginate(3);  //retrieve records in paginations format, 3 per page.

        //go to the view folder and look for locations folder and then
        //a file named create.blade.php
        return view('subcategories.create', compact('categories'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Save into the database
        $this->validate($request, ['subcategory'=>'required|max:255']);

        $subcategory = new Subcategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory = $request->subcategory;
        $subcategory->note = $request->note;

        //if insert is successful then we want to redirect to view to show to the user
        if ($subcategory->save()){    
            return redirect()->route('subcategories.index', $subcategory->id);
        }
        else {
            return redirect()->route('subcategories.create');
        }

        //Sublocation::create($validatedData);
        return redirect()->back()->with('message', 'Subcategory created!');
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
        $subcategory = Subcategory::findOrFail($id); //In case the id is not found
        //$subcategory = Subcategory::findOrFail($subcategory->category_id);

        //return the view with some info, first parameter is the name of the data
        //we want to refer to. Second parameter is the actual data we want to pass into
        //return view('sublocations.show')->with('sublocation', $sublocation); 
        return view('subcategories.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //edit subcategory
        $subcategory = Subcategory::findOrFail($id); //In case the id is not found
        return view('subcategories.edit', compact('subcategory')); 
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
        $subcategory = Subcategory::findOrFail($id); //In case the id is not found
        $this->validate($request, ['subcategory'=>'required|max:255']);

        $subcategory->subcategory = $request->get('subcategory');
        $subcategory->note = $request->get('note'); 
        $subcategory->save();

        return redirect()->route('subcategories.index')->with('message', 'Subcategory Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete a subcategory
        $subcategory = Subcategory::findOrFail($id); //In case the id is not found
        $subcategory->delete();

        return redirect()->route('subcategories.index')->with('message', 'Subcategory Deleted.');
    }
}
