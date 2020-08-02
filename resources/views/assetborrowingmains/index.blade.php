@extends('layouts.dt_template')

@section('main')

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

        </table>
    </div>


    <script type="text/javascript">
    $(document).ready(function() {
        $('#asset_borrowing_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('AssetBorrowing.getdata') }}",
            "columns":[
                { "data": "asset" },
                { "data": "subcategory_id" },
                { "data": "sublocation_id" },
                { "data": "brand_id" },
                { "data": "note" }
            ]
        });
    });
    </script>
@endsection