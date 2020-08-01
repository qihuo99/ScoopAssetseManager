
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
        <table class="table table-bordered table-striped">
            <tr>   
                <th width="30%">Asset</th>
                <th width="20%">Category</th>
                <th width="20%">Location</th>
                <th width="10%">Brand</th>
                <th width="15%">Note</th>
                <th width="25%">Action3</th>
            </tr>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->asset }}</td>
                <td>{{ $row->maincategory_subcategory  }}</td>
                <td>{{ $row->mainlocation_sublocation }}</td> 
                <td>{{ $row->brand }}</td>
                <td>{{ $row->note }}</td>
                <td>
                    <form action="{{ route('assetborrowingmains.destroy', $row->id) }}" method="post">
                        <a href="{{ route('assetborrowingmains.show', $row->id) }}" class="btn btn-mini btn-primary display-4"><span style="font-size:smaller;">Show</span></a>
                        <a href="{{ route('assetborrowingmains.edit', $row->id) }}" class="btn btn-mini btn-warning display-4"><span style="font-size:smaller;">Edit</span></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-mini btn-danger"><span style="font-size:smaller;">Delete</span></button>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>
    </div>
    {!! $data->links() !!}
@endsection