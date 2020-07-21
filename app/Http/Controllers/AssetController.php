<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //$this->validate($request, ['asset'=>'required|max:255']);
        $request->validate([
            'asset'=>'required|max:255',
            'sublocation_id'=>'required',
            'subcategory_id'=>'required',
            'brand_id'=>'required',
        ]);

        $inputValue = $request->all();

        $asset = new Asset();
        $asset->brand_id = $request->brand_id;
        $asset->sublocation_id = $request->sublocation_id ;
        $asset->subcategory_id = $request->subcategory_id;
        $asset->asset = $request->asset;
        $asset->note = $request->note;

        echo 'asset->subcategory_id='.$asset->subcategory_id;
        echo 'has_tag='.$request->input('has_tag');
        //exit;
        //echo 'asset->subcategory_id='.$asset->subcategory_id;

        //$asset->has_tag = $request->input('has_tag');
        if (empty($inputValue['has_tag'])) {
            // Do anything here\
            $asset->has_tag = false;//
        }
        else{
            $asset->has_tag = true;//..
        }

        //if( $request->has('has_tag') ){
       //     $asset->has_tag = true;//...
       // }
        //else{
       //     $asset->has_tag = false;//..
       // }

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
        //$subcategory = Subcategory::findOrFail($id);
        //$subcategories = Subcategory::all();
        //echo 'assetid='.$id;
        //echo 'asset->subcategory_id='.$asset->subcategory_id;

        $brands = DB::table('brands')->where('id', '=', $asset->brand_id)->get();
        $subcategories = DB::table('subcategories')->where('id', '=', $asset->subcategory_id)->get();
        $sublocations = DB::table('sublocations')->where('id', '=', $asset->sublocation_id)->get();

        //$subcategory = Subcategory::findOrFail($asset->subcategory_id); //In case the id is not found
        //$subcategory = Subcategory::with('assets')->findOrFail($asset->subcategory_id);

        //return the view with some info, first parameter is the name of the data
        //we want to refer to. Second parameter is the actual data we want to pass into
        return view('assets.show', compact('asset', 'brands', 'subcategories', 'sublocations'));
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
        $asset = Asset::findOrFail($id);
        $brands = Brand::all();
        $sublocations = Sublocation::all();
        $subcategories = Subcategory::all();

        return view('assets.edit', compact('asset', 'brands', 'subcategories', 'sublocations')); 
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
        $request->validate([
            'asset'=>'required|max:255',
            'sublocation_id'=>'required',
            'subcategory_id'=>'required',
            'brand_id'=>'required',
        ]);

        echo 'asset current id='.$id;
        //echo '$request->get.brand_id='.$request->get('brand_id');
        //echo '$request->get.sublocation_id='.$request->get('sublocation_id');
        //echo '$request->get.subcategory_id='.$request->get('subcategory_id');
        //echo '$request->get.note='.$request->get('note');
        //echo '$request->get.asset='.$request->get('asset');
        $asset = DB::table('assets')->where('id', '=', $id)->get();
        //$asset = Asset::findOrFail($id);
        //$asset->brand_id = $request->get('brand_id'); 
        //$asset->sublocation_id =$request->get('sublocation_id');  
        //$asset->subcategory_id = $request->get('subcategory_id');
        //$asset->asset = $request->get('asset');
        //$asset->note = $request->get('note');
        $asset->update_user = Auth::user()->id; 
        //$asset->save();

        if ($asset->save()){
            return redirect()->route('assets.index', $asset->id);
        }
        else {
            return redirect()->route('assets.edit');
        }

        //return view('assets.edit', compact('asset')); 
       // return redirect()->route('assets.index')->with('message', 'Sublocation Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete a sublocation
        $asset = Asset::findOrFail($id); //In case the id is not found
        $asset->delete();

        return redirect()->route('assets.index')->with('message', 'Asset Deleted.');
    }

}
