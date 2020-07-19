<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Asset;
use App\Brand;
use App\Sublocation;
use App\Subcategory;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //$sublocation = Sublocation::all();  //retrieve all records

        //Order by will display the latest assets entries first, in desc order
        $assets = Asset::orderBy('id', 'desc')->paginate(6);  //retrieve records in paginations format, 3 per page.

        //return view('locations.index')->with('locations', $loc);
        return view('assets.index')->with('assets', $assets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //defines brands data and retrieve
        $brands = Brand::all();
        $sublocations = Sublocation::all();
        $subcategories = Subcategory::all();

        //Order by will display the latest location entries first, in desc order
        $assets = Asset::orderBy('id', 'desc')->paginate(8);  //retrieve records in paginations format, 3 per page.

        //go to the view folder and look for locations folder and then
        //a file named create.blade.php
        return view('assets.create', compact('brands', 'sublocations', 'subcategories'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //save a sublocation record with location_id fk key
        $this->validate($request, ['asset'=>'required|max:255']);

        $asset = new Asset();
        $asset->brand_id = $request->brand_id;
        $asset->asset = $request->asset;
        $asset->note = $request->note;
        $asset->create_user = Auth::user()->id;

        //if insert is successful then we want to redirect to view to show to the user
        if ($asset->save()){
            return redirect()->route('assets.index', $asset->id);
        }
        else {
            return redirect()->route('assets.create');
        }

        return redirect()->back()->with('message', 'Asset created!');
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
        $asset = Asset::findOrFail($id); //In case the id is not found
        //$asset = Asset::findOrFail($asset->brand_id);

        //return the view with some info, first parameter is the name of the data
        //we want to refer to. Second parameter is the actual data we want to pass into
        return view('assets.show', compact('asset'));
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

    public function brand()
    {
        //SELECT * FROM `addresses` WHERE user_id = ??
        //id is the default PK, so the relation is automatically
        //being figured out. Since this is User model, so FK, by
        //default, should be user_id, if use a different name, then it
        //won't work.
        //return $this->hasOne('App\Location');
        //return $this->hasOne(Location::class); //the two lines will do the same thing

        return $this->hasMany(Brand::class);
    }
}
