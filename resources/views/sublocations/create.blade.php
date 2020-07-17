@extends('layouts.app')

@section('content')
    <div class="container">                     
        <h1>Add a new sublocation:</h1>  
        <hr />
        <form action="{{ route('sublocations.store') }}" method="POST"> 
                <!-- csrf will prevent cross-browser submission
                csrf_field() will create hidden field with token values in the form
                so the form can be submitted successfully to the database
                -->
                {{ csrf_field() }} 

                <div class="form-group">
                    <label for="location_id">Location</label>
                    <select name="location_id" id="location_id" class="form-control">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->location }}</option>
                    @endforeach
                    </select>
                </div>
                <label for="sublocation">Sublocation: </label>
                <input type="text" name="sublocation" id="sublocation" class="form-control @error('sublocation') is-invalid @enderror" />    
                @error('sublocation')
                    <span class="invalid-feedback font-weight-bold text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br /><br />
                <label for="note">More Information (Note): </label>
                <textarea class="form-control" name="note" id="note" rows="4"></textarea>
                <br />
                <input type="submit" class="" value="Add" />
            </form>
    </div>
@endsection