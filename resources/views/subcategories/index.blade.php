@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="container">         
        <h1>All Subcategories:</h1>
        <ul class="nav nav-list">
            <li class="divider mr-lg-5"><a href="/subcategories/create" class="btn btn-primary" style="margin-top: 5px;">Add A New Subcategory </a></li>
        </ul>
        <hr />
        <table class="table table-striped table-bordered text-center table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center align-middle">Id</td>
                    <th scope="col" class="text-center align-middle">Main Category</td>
                    <th scope="col" class="text-center align-middle">Subcategory</td>
                    <th scope="col" class="text-center align-middle">Note</td>
                    <th scope="col" class="text-center align-middle">Main Category-Subcategory</td>
                    <th scope="col" class="text-center align-middle">View Details</td>
                    <th scope="col" class="text-center align-middle">Edit</td>
                    <th scope="col" class="text-center align-middle">Delete</td>
                </tr>
            </thead>
            </thead>
            <tbody>
                @foreach ($subcategories as $subcategory)
                <tr>
                    <th scope="row" class="text-center align-middle">{{ $subcategory->id }}</td>
                    <td>{{ $subcategory->maincategory}}</td>
                    <td>{{ $subcategory->subcategory }}</td>
                    <td>{{ $subcategory->note }}</td>
                    <td>{{ $subcategory->maincategory_subcategory}}</td>
                    <td><a href="{{ route('subcategories.show', $subcategory->id) }}" class="btn btn-primary m-2">View Details</a></td>
                    <td><a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-primary m-2">Edit</a></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#exampleModalCenter{{ $subcategory->id }}">
                        Delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter{{ $subcategory->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST">                               
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Delete {{ $subcategory->category->category }} - {{ $subcategory->subcategory }} :</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body font-weight-bold text-danger">
                                            Are you sure you want to delete {{ $subcategory->category->category }} - {{ $subcategory->subcategory }} ?
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
        
        {!! $subcategories->links() !!}  {{-- this is for adding pagination function --}}
    </div>

@endsection