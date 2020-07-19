@extends('layouts.app')

@section('content')

    <div class="container"> 
        <h1>Asset Data Page:</h1>
        <hr /> 
        <br />
        <div class="form-group">
            <label for="brand" class="font-weight-bold"><h1>Brand:</h1></label>
            <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="brand" readonly value="{{ $asset->brand_id }}">
        </div>



        <div class="form-group">
            <label for="asset"><h2>Asset:</h2></label>
            <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="asset" readonly value="{{ $asset->asset }}">
        </div>
        <div class="form-group">
            <label for="note"><h2>Asset Note:</h2></label>
            <textarea class="form-control rounded-0 text-primary input-lg" id="note" readonly rows="5">{{ $asset->note }}</textarea>
        </div>
    </div>

@endsection

    
