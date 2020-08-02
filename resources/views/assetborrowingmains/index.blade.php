
@extends('layouts.dt_template')

@section('main')

    <div align="right">
        <a href="{{ route('assetborrowingmains.create') }}" class="btn btn-success btn-sm">Add</a>
    </div>
    <br />
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif    

    <div class="table-responsive">
        <table  id="asset_borrowing_table" class="table table-bordered table-striped"  style="width:100%">
            <tr>   
                <th width="30%">Asset</th>
                <th width="20%">Category</th>
                <th width="20%">Location</th>
                <th width="10%">Brand</th>
                <th width="15%">Note</th>
            </tr>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->asset }}</td>
                <td>{{ $row->maincategory_subcategory  }}</td>
                <td>{{ $row->mainlocation_sublocation }}</td> 
                <td>{{ $row->brand }}</td>
                <td>{{ $row->note }}</td>
            </tr>
            @endforeach

        </table>
    </div>
    {!! $data->links() !!}

@endsection