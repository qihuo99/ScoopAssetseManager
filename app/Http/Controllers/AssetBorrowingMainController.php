<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Asset;
use App\AssetBorrowingMain;
use Datatables;

class AssetBorrowingMainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = Asset::latest()->paginate(8);

        $data = DB::table('assets')
        ->join('brands', 'brands.id', '=', 'assets.brand_id')
        ->join('sublocations', 'sublocations.id', '=', 'assets.sublocation_id')
        ->join('subcategories', 'subcategories.id', '=', 'assets.subcategory_id')
        ->select('assets.id','brands.brand', 'sublocations.mainlocation_sublocation', 'subcategories.maincategory_subcategory','assets.asset', 'assets.note' )
        //->get()
        ->paginate(6);

        //print_r($assets);
        //die;
        //dd($assetdata);
        //return view('assets.index',  compact('assetdata') );

        return view('assetborrowingmains.index', compact('data'))
        ->with('i', (request()->input('page', 1) - 1) * 6);
        //return view('assetborrowingmains.index');  
        //127.0.0.1:8000/assetborrowingmains  ==> this is the localhost url
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
        //
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
