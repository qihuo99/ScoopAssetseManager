@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Update an existing location:</h1>
        <hr />
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        <form action="{{ route('locations.update', $location->id) }}" method="POST"> 
            {{ method_field('PUT') }}
            <!-- csrf will prevent cross-browser submission
            csrf_field() will create hidden field with token values in the form
            so the form can be submitted successfully to the database
            -->
            {{ csrf_field() }} 

            <label for="location">Location: </label>
            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{$location->location}}" />      
            @error('location')
                <span class="invalid-feedback font-weight-bold text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br />
            <label for="note">More Information (Note): </label>
            <textarea class="form-control" name="note" id="note" rows="4">{{ $location->note }}</textarea>
            <br />
            <input type="submit" class="" value="Update" />
        </form>
    </div> 

@endsection