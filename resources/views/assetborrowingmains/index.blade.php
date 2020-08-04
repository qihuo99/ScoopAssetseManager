@extends('layouts.dt_template')

@section('main')
    <h1>Assets Borrowing Index Page:</h1>
    <br />
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif   

    <div class="table-responsive">
        <table id="asset_borrowing_table" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>   
                    <th width="10%">ID</th>
                    <th width="25%">Asset ID Selected</th>
                    <th width="15%">Note</th>
                    <th width="15%">Create Date</th> 
                    <th width="15%">Create User</th>                    
                    <th width="30%">View</th>
                    <th width="30%">Edit</th>
                </tr>
            </thead>
        </table>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#asset_borrowing_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('AssetBorrowing.getdataforindexpage') }}",
            "columns":[
                { "data": "id", name: 'id' },
                { "data": "asset_id_selected", name: 'asset_id_selected' },
                { "data": "note", name: 'note' },
                { "data": "created_at", name: 'created_at' },
                { "data": "create_user", name: 'create_user' },
                { "data": "view", name: 'view', orderable: false  },
                { "data": "edit", name: 'edit', orderable: false  }
            ]
        });
    });
    </script>


@endsection