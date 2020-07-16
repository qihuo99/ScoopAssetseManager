@extends('layouts.app')

@section('content')

    <div class="container"> 
        <div class="form-group">
            <h1> Brand Data Page:</h1>
            <hr /> 
            <br />
            <label for="brand"><h2>Brand:</h2></label>
            <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="brand" readonly value="{{ $brand->brand }}">
        </div>
        <div class="form-group">
            <label for="brandNote"><h2>Brand Note:</h2></label>
            <textarea class="form-control rounded-0 text-primary input-lg" id="brandNote" readonly rows="5">{{ $brand->note }}</textarea>
        </div>
    </div>

@endsection

    
