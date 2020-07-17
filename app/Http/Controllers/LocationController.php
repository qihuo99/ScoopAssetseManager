<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //this is the home page of Location 
        //$location = Location::all();  //retrieve all records

        //Order by will display the latest location entries first, in desc order
        $location = Location::orderBy('id', 'desc')->paginate(6);  //retrieve records in paginations format, 3 per page.

        return view('locations.index')->with('locations', $location);
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
        return view('locations.create');  
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
         $this->validate($request, ['location'=>'required|max:255']);
          
         $location = new Location();
         $location->location = $request->location;
         $location->note = $request->note;
         //$loc->create_user = $user->name;
 
         //if insert is successful then we want to redirect to view to show to the user
         if ($location->save()){
             return redirect()->route('locations.index', $location->id);
         }
         else {
             return redirect()->route('locations.create');
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
        $location = Location::findOrFail($id); //In case the id is not found

        //return the view with some info, first parameter is the name of the data
        //we want to refer to. Second parameter is the actual data we want to pass into
        return view('locations.show')->with('location', $location); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id); //In case the id is not found
        return view('locations.edit', compact('location')); 
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
        //update a record
        $loc = Location::findOrFail($id); //In case the id is not found
        $this->validate($request, ['location'=>'required|max:255']);

        $loc->location = $request->get('location');
        $loc->note = $request->get('note'); 
        $loc->save();

        return redirect()->route('locations.index')->with('message', 'Location Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete a record
        $loc = Location::findOrFail($id); //In case the id is not found
        $loc->delete();

        return redirect()->route('locations.index')->with('message', 'Location Deleted.');
    }

    public function sublocation()
    {
        //SELECT * FROM `addresses` WHERE user_id = ??
        //id is the default PK, so the relation is automatically
        //being figured out. Since this is User model, so FK, by
        //default, should be user_id, if use a different name, then it
        //won't work.
        //return $this->hasOne('App\Location');
        //return $this->hasOne(Location::class); //the two lines will do the same thing

        return $this->hasOne(Location::class);
    }
}
