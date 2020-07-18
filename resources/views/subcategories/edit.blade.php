@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Update an existing subcategory:</h1>
        <hr />
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST"> 
            @method('PUT')
            <!-- csrf will prevent cross-browser submission
            csrf_field() will create hidden field with token values in the form
            so the form can be submitted successfully to the database
            -->
            @csrf

            <label for="category">Category: </label>
            <input type="text" name="category" id="category" readonly class="form-control @error('category') is-invalid @enderror" value="{{ $subcategory->category->category }}" />      
            <br />
            <label for="subcategory">Subcategory: </label>
            <input type="text" name="subcategory" id="subcategory" class="form-control @error('subcategory') is-invalid @enderror" value="{{$subcategory->subcategory}}" />      
            @error('sublocation')
                <span class="invalid-feedback font-weight-bold text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br />
            <label for="note">More Information (Note): </label>
            <textarea class="form-control" name="note" id="note" rows="4">{{ $subcategory->note }}</textarea>
            <br />
            <input type="submit" class="" value="Update" />
        </form>
    </div> 

@endsection