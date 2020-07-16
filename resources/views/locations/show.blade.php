@extends('layouts.app')

@section('content')

    <div class="container"> 
        <div class="form-group">
            <h1> Location Data Page:</h1>
            <hr /> 
            <br />
            <label for="location"><h2>Location:</h2></label>
            <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="sublocation" readonly value="{{ $location->location }}">
        </div>
        <div class="form-group">
            <label for="locationNote"><h2>Location Note:</h2></label>
            <textarea class="form-control rounded-0 text-primary input-lg" id="locationNote" readonly rows="5">{{ $location->note }}</textarea>
        </div>
    </div>

@endsection

    
