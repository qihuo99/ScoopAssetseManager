@extends('layouts.app')

@section('content')

    <div class="container"> 
        <h1> Sublocation Data Page:</h1>
        <hr /> 
        <br />
        <div class="form-group">
            <label for="location" class="font-weight-bold"><h1>Main Location:</h1></label>
            <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="location" readonly value="{{ $sublocation->location->location }}">
        </div>
        <div class="form-group">
            <label for="sublocation"><h2>Sublocation:</h2></label>
            <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="sublocation" readonly value="{{ $sublocation->sublocation }}">
        </div>
        <div class="form-group">
            <label for="note"><h2>Sublocation Note:</h2></label>
            <textarea class="form-control rounded-0 text-primary input-lg" id="note" readonly rows="5">{{ $sublocation->note }}</textarea>
        </div>
    </div>

@endsection

    
