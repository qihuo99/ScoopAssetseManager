@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="container">         
        <h1>All Brands:</h1>
        <ul class="nav nav-list">
            <li class="divider mr-lg-5"><a href="/brands/create" class="btn btn-primary" style="margin-top: 5px;">Add A New Brand</a></li>
         
        </ul>
        <hr />
        <table class="table table-striped table-bordered text-center table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">Id</td>
                    <th scope="col" class="text-center">Brand</td>
                    <th scope="col" class="text-center">Note</td>
                    <th scope="col" class="text-center">Create Date</td>
                    <th scope="col" class="text-center">View Details</td>
                    <th scope="col" class="text-center">Edit</td>
                    <th scope="col" class="text-center">Delete</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                <tr>
                    <th scope="row">{{ $brand->id }}</td>
                    <td>{{ $brand->brand }}</td>
                    <td>{{ $brand->note }}</td>
                    <td>{{ $brand->created_at}}</td>
                    <td><a href="{{ route('brands.show', $brand->id) }}" class="btn btn-primary m-2">View Details</a></td>
                    <td><a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-primary m-2">Edit</a></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#exampleModalCenter{{ $brand->id }}">
                        Delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            
                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">                               
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Selected Brand:</h5>
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
        
        {!! $brands->links() !!}  {{-- this is for adding pagination function --}}
    </div>

@endsection