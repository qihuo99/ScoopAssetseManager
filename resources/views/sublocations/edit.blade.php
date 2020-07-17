@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Update an existing sublocation:</h1>
        <hr />
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        <form action="{{ route('sublocations.update', $sublocation->id) }}" method="POST"> 
            {{ method_field('PUT') }}
            <!-- csrf will prevent cross-browser submission
            csrf_field() will create hidden field with token values in the form
            so the form can be submitted successfully to the database
            -->
            {{ csrf_field() }} 

            <label for="location">Location: </label>
            <input type="text" name="location" id="location" readonly class="form-control @error('location') is-invalid @enderror" value="{{ $sublocation->location->location }}" />      
            <br />
            <label for="sublocation">Sublocation: </label>
            <input type="text" name="sublocation" id="sublocation" class="form-control @error('sublocation') is-invalid @enderror" value="{{$sublocation->sublocation}}" />      
            @error('sublocation')
                <span class="invalid-feedback font-weight-bold text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br />
            <label for="note">More Information (Note): </label>
            <textarea class="form-control" name="note" id="note" rows="4">{{ $sublocation->note }}</textarea>
            <br />
            <input type="submit" class="" value="Update" />
        </form>
    </div> 

@endsection