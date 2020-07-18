@extends('layouts.app')

@section('content')

    <div class="container"> 
        <h1>SubCtegory Data Page:</h1>
        <hr /> 
        <br />
        <div class="form-group">
            <label for="category" class="font-weight-bold"><h1>Main Category:</h1></label>
            <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="category" readonly value="{{ $subcategory->category->category }}">
        </div>

        <div class="form-group">
            <label for="subcategory"><h2>Subcategory :</h2></label>
            <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="subcategory" readonly value="{{ $subcategory->subcategory }}">
        </div>
        <div class="form-group">
            <label for="note"><h2>Subcategory Note:</h2></label>
            <textarea class="form-control rounded-0 text-primary input-lg" id="note" readonly rows="5">{{ $subcategory->note }}</textarea>
        </div>   
    </div>

@endsection

    
