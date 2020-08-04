@extends('layouts.dt_template')

@section('main')
    <h1>Create New Assets Borrowing Data:</h1>
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
                    <th width="25%">Asset</th>
                    <th width="10%">Category</th>
                    <th width="10%">Location</th>
                    <th width="10%">Brand</th>
                    <th width="15%">Note</th>
                    <th>
                        <button type="button" name="bulk_insert" id="bulk_insert" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#asset_borrowing_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('AssetBorrowing.getdataforcreatnew') }}",
            "columns":[
                { "data": "asset" },
                { "data": "maincategory_subcategory" },
                { "data": "mainlocation_sublocation" },
                { "data": "brand" },
                { "data": "note" },
                { "data":"checkbox", orderable:false, searchable:false}
            ]
        });

        //bulk insert 
        $(document).on('click', '#bulk_insert', function(){
            var id = [];

            if(confirm("Are you sure you want to insert all these datas?"))
            {
                $('.asset_checkbox:checked').each(function(){
                    id.push($(this).val());
                });

                if(id.length > 0)
                {
                    alert(id);
                    console.log('id checkbox values = ' + id);
 
                    $.ajax({
                        url:"{{ route('AssetBorrowing.masscreate')}}",
                        method:"get",
                        data:{id:id},
                        success:function(response)
                        {
                            alert(response);
                            //console.log(response); 
                            
                            $('#asset_borrowing_table').DataTable().ajax.reload();
                        }
                    });

                }
                else
                {
                    alert("Please select at least one checkbox");
                }
            }

        }); 





    });
    </script>


@endsection