@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="container">         
        <h1>All Assets:</h1>
        <ul class="nav nav-list">
            <li class="divider mr-lg-5"><a href="/assets/create" class="btn btn-primary" style="margin-top: 5px;">Add A New asset</a></li>
        </ul>
        <hr />
        <table class="table table-striped table-bordered text-center table-hover table-sm ">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center align-middle">Id</td>
                    <th scope="col" class="text-center align-middle">Asset</td>
                    <th scope="col" class="text-center align-middle">Brand</td>
                    <th scope="col" class="text-center align-middle">Location</td>
                    <th scope="col" class="text-center align-middle">Category</td> 
                    <th scope="col" class="text-center align-middle">Note</td>
                    <th scope="col" class="text-center align-middle">View Details</td>
                    <th scope="col" class="text-center align-middle">Edit</td>
                    <th scope="col" class="text-center align-middle">Delete</td>
                </tr>
            </thead>
            </thead>
            <tbody>
                @foreach ($assetdata as $asset)
                <tr>
                    <th scope="row" class="text-center align-middle">{{ $asset->id }}</td>
                    <td>{{ $asset->asset }}</td>
                    <td>{{ $asset->brand }}</td>
                    <td>{{ $asset->mainlocation_sublocation  }}</td>
                    <td>{{ $asset->maincategory_subcategory  }}</td>
                    <td>{{ $asset->note }}</td>
                    <td><a href="{{ route('assets.show', $asset->id) }}" class="btn btn-primary m-2">View</a></td>
                    <td><a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-primary m-2">Edit</a></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#exampleModalCenter{{ $asset->id }}">
                        Delete
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter{{ $asset->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST">                               
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Delete  {{ $asset->asset }} :</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body font-weight-bold text-danger">
                                            Are you sure you want to delete ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
         {!! $assetdata->links() !!}  {{-- this is for adding pagination function --}}
    </div>

@endsection