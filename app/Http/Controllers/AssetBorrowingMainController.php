<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Asset;
use App\AssetBorrowingMain;
use Yajra\Datatables\Datatables;

class AssetBorrowingMainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$data = AssetBorrowingMain::select('id','asset_id','note','reated_at');
        //$data  = AssetBorrowingMain::all();
        if($request->ajax())
        {
            $data = AssetBorrowingMain::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }


        return view('assetborrowingmains.index');
        //return view('assetborrowingmains.index', compact('data'));
        //$data = Asset::latest()->paginate(8);

        //$data = DB::table('assets')
        //->join('brands', 'brands.id', '=', 'assets.brand_id')
        //->join('sublocations', 'sublocations.id', '=', 'assets.sublocation_id')
       // ->join('subcategories', 'subcategories.id', '=', 'assets.subcategory_id')
       // ->select('assets.id','brands.brand', 'sublocations.mainlocation_sublocation', 'subcategories.maincategory_subcategory','assets.asset', 'assets.note' )
       // //->get()
       // ->paginate(6);

        //return view('assetborrowingmains.index', compact('data'))
       // ->with('i', (request()->input('page', 1) - 1) * 6);
        //return view('assetborrowingmains.index');  
        //127.0.0.1:8000/assetborrowingmains  ==> this is the localhost url
    }

    function getdataforcreatnew()
    {
        
        $data = DB::table('assets')
                ->join('brands', 'brands.id', '=', 'assets.brand_id')
                ->join('sublocations', 'sublocations.id', '=', 'assets.sublocation_id')
                ->join('subcategories', 'subcategories.id', '=', 'assets.subcategory_id')
            ->select('assets.id','assets.asset', 'assets.note','brands.brand', 'sublocations.mainlocation_sublocation', 'subcategories.maincategory_subcategory' )
            ->get();

        return Datatables::of($data)
            ->addColumn('checkbox', '<input type="checkbox" name="asset_checkbox[]" class="asset_checkbox" value="{{$id}}" />')
            ->rawColumns(['checkbox','action'])
            ->make(true);
    }

    function getdataforindexpage()
    {
        //$assets = Asset::select('id','asset','brand_id','sublocation_id','subcategory_id','note');
        $data = AssetBorrowingMain::select('id','asset_id_selected','note', 'created_at');
        //$data  = AssetBorrowingMain::all();
        return Datatables::of($data)
            ->addColumn('action', function($data){
                $button = '<button 
                                type="button" 
                                name="edit" 
                                id="'.$data->id.'"
                                class="edit btn btn-primary btn-mini">Edit</button>';
                    //$button .= '&nbsp;&nbsp';
                    //$button .= '<button type="button" name="delete" id="'.$data->id.'"
                    //class="delete btn btn-danger btn-mini">Delete</button>';
            return $button;
        })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('assetborrowingmains.create');
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
