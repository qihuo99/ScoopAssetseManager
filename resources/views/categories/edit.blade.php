@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Update an existing Category:</h1>
        <hr />
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        <form action="{{ route('categories.update', $category->id) }}" method="POST"> 
            {{ method_field('PUT') }}
            <!-- csrf will prevent cross-browser submission
            csrf_field() will create hidden field with token values in the form
            so the form can be submitted successfully to the database
            -->
            {{ csrf_field() }} 

            <label for="category">Category: </label>
            <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{$category->category}}" />      
            @error('brand')
                <span class="invalid-feedback font-weight-bold text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br />
            <label for="note">More Information (Note): </label>
            <textarea class="form-control" name="note" id="note" rows="4">{{ $category->note }}</textarea>
            <br />
            <input type="submit" class="" value="Update" />
        </form>
    </div> 

@endsection