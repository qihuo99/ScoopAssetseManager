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
        //$assets = Asset::all()->paginate(3);  //retrieve records in paginations format, 3 per page.
        //$assets  = Asset::orderBy('id', 'desc')->paginate(6);

        $assetdata = DB::table('assets')
        ->join('brands', 'brands.id', '=', 'assets.brand_id')
        ->join('sublocations', 'sublocations.id', '=', 'assets.sublocation_id')
        ->join('subcategories', 'subcategories.id', '=', 'assets.subcategory_id')
        ->select('assets.id','assets.image','brands.brand', 'sublocations.mainlocation_sublocation', 'subcategories.maincategory_subcategory','assets.asset', 'assets.note' )
        //->get()
        ->paginate(5);

        //print_r($assets);
        //die;
        //dd($assetdata);
        return view('assets.index',  compact('assetdata') );
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

        //$inputValue = $request->all();
        //Very important, in order for checkbox values to passed to 
        //the controller successfully, both id and name must be specified in blade

        $asset = new Asset();
        $asset->brand_id = $request->brand_id;
        $asset->sublocation_id = $request->sublocation_id ;
        $asset->subcategory_id = $request->subcategory_id;
        $asset->asset = $request->asset;
        $asset->note = $request->note;
        $asset->has_tag = $request->has('has_tag');
        //$data = $request->all();
        //dd($data);
        $image = $request->file('image');
        //dd($image);
        $image_name = $request->image->getClientOriginalName();
        $asset->image = $image_name; 
        //dd($image );
        $image->move(public_path('images'), $image_name);
        $asset->create_user = Auth::user()->id;
        //var_dump($inputValue);
        //die();
       // echo '--that is today!';
        //dd($asset);

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

        //dd($id); //
        $inputValue = $request->all();
        //dd($inputValue);

        $asset = Asset::findOrFail($id);
        $asset->asset = $request->get('asset');
        $asset->brand_id = $request->get('brand_id'); 
        $asset->sublocation_id =$request->get('sublocation_id');  
        $asset->subcategory_id = $request->get('subcategory_id');
        $asset->note = $request->get('note');
        $asset->update_user = Auth::user()->id; 
        //print_r($asset);
        //die();
        $asset->save();

        return redirect()->route('assets.index')->with('message', 'Sublocation Updated.');
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
