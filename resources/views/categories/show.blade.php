@extends('layouts.app')

@section('content')

    <div class="container"> 
        <div class="form-group">
            <h1>Category Data Page:</h1>
            <hr /> 
            <br />
            <label for="category"><h2>Category :</h2></label>
            <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="category" readonly value="{{ $category->category }}">
        </div>
        <div class="form-group">
            <label for="note"><h2>Category Note:</h2></label>
            <textarea class="form-control rounded-0 text-primary input-lg" id="note" readonly rows="5">{{ $category->note }}</textarea>
        </div>
    </div>

@endsection

    
