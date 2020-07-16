@extends('layouts.app')

@section('content')
    <div class="container">                     
        <h1>Add A New Brand:</h1>  
        <hr />
        <form action="{{ route('brands.store') }}" method="POST"> 
            <!-- csrf will prevent cross-browser submission
            csrf_field() will create hidden field with token values in the form
            so the form can be submitted successfully to the database
            -->
            @csrf
            <label for="brand">Brand: </label>
            <input type="text" name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" />    
            @error('brand')
                <span class="invalid-feedback font-weight-bold text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br />
            <label for="note">More Information (Note): </label>
            <textarea class="form-control" name="note" id="note" rows="4"></textarea>
            <hr />
            <input type="submit" class="btn btn-primary" value="Add" />
        </form>
    </div>
@endsection