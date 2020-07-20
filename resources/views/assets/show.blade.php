@extends('layouts.app')

@section('content')

    <div class="container"> 
        <h1>Asset Data Page:</h1>
        <hr /> 
        <br />
        <div class="form-group">
            <label for="asset" class="font-weight-bold"><h1>Asset:</h1></label>
            <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="asset" readonly value="{{ $asset->asset }}">
        </div>
        <div class="form-group row">
            <div class="col-sm-4">  
                <div class="form-group">
                @foreach ($subcategories as $subcategory)
                    @if ($subcategory)
                        <label for="subcategory" class="font-weight-bold"><h1>Category:</h1></label>
                        <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="subcategory" readonly value="{{ $subcategory->maincategory_subcategory }}">
                    @else
                        <p>There is no category record</p>
                    @endif
                @endforeach
                </div>
            </div>
            <div class="col-sm-4">  
                <div class="form-group">
                @foreach ($sublocations as $sublocation)
                    @if ($sublocation)
                        <label for="sublocation" class="font-weight-bold"><h1>Location:</h1></label>
                        <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="sublocation" readonly value="{{ $sublocation->mainlocation_sublocation }}">
                    @else
                        <p>There is no location record</p>
                    @endif
                @endforeach
                </div>
            </div>
            <div class="col-sm-4">  
                <div class="form-group">
                <label for="brand" class="font-weight-bold"><h1>Brand:</h1></label>
                @foreach ($brands as $brand) 
                    @if ($brand)                
                        <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="brand" readonly value="{{ $brand->brand }}">
                    @else
                        <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="brand" readonly value="N/A">
                    @endif
                @endforeach
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="note"><h2>Asset Note:</h2></label>
            <textarea class="form-control rounded-0 text-primary input-lg" id="note" readonly rows="5">{{ $asset->note }}</textarea>
        </div>
    </div>

@endsection

    
