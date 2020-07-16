@extends('layouts.app')

@section('content')
    <div class="container">                     
        <h1>Add a new location:</h1>  
        <hr />
        <form action="{{ route('locations.store') }}" method="POST"> 
            <!-- csrf will prevent cross-browser submission
            csrf_field() will create hidden field with token values in the form
            so the form can be submitted successfully to the database
            -->
            @csrf
            <label for="location">Location: </label>
            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" />    
            @error('location')
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