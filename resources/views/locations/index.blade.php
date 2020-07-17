@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="container">         
        <h1>All Locations:</h1>
        <ul class="nav nav-list">
            <li class="divider mr-lg-5"><a href="/locations/create" class="btn btn-primary" style="margin-top: 5px;">Add A New Location</a></li>
         
        </ul>
        <hr />
        <table class="table table-striped table-bordered text-center table-hover table-sm ">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center align-middle">Id</td>
                    <th scope="col" class="text-center align-middle">Location</td>
                    <th scope="col" class="text-center align-middle">Note</td>
                    <th scope="col" class="text-center align-middle">Create Date</td>
                    <th scope="col" class="text-center align-middle">View Details</td>
                    <th scope="col" class="text-center align-middle">Edit</td>
                    <th scope="col" class="text-center align-middle">Delete</td>
                </tr>
            </thead>
            </thead>
            <tbody>
                @foreach ($locations as $location)
                <tr>
                    <th scope="row" class="text-center align-middle">{{ $location->id }}</td>
                    <td>{{ $location->location }}</td>
                    <td>{{ $location->note }}</td>
                    <td>{{ $location->created_at}}</td>
                    <td><a href="{{ route('locations.show', $location->id) }}" class="btn btn-primary m-1">View Details</a></td>
                    <td><a href="{{ route('locations.edit', $location->id) }}" class="btn btn-primary m-1">Edit</a></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#exampleModalCenter{{ $location->id }}">
                        Delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter{{ $location->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            
                                <form action="{{ route('locations.destroy', $location->id) }}" method="POST">                               
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Selected Location:</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure?
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
        
        {!! $locations->links() !!}  {{-- this is for adding pagination function --}}
    </div>

@endsection