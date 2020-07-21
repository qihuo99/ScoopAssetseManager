@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Update an existing asset:</h1>
        <hr />
        <p>currentasset_id |  </p>  
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        <form action="{{ route('assets.update', $asset->id) }}" method="POST"> 
            @method('PUT')

            <!-- csrf will prevent cross-browser submission
            csrf_field() will create hidden field with token values in the form
            so the form can be submitted successfully to the database
            -->
            @csrf
            <div class="form-group">
                <label for="asset" class="font-weight-bold"><h1>Asset: {{ $asset->brand_id}}</h1></label>
                <input type="text" class="form-control text-primary font-weight-bold badge-light input-lg" id="asset" value="{{ $asset->asset }}">
                @error('asset')
                <span class="invalid-feedback font-weight-bold text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row">
                <div class="col-sm-4">  
                    <label for="subcategory_id">Main Category - Subcategory</label>
                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                        @foreach ($subcategories as $subcategory)
                            @if ($subcategory->id == $asset->subcategory_id )
                                <option value="{{ $subcategory->id }}" selected="selected">{{ $subcategory->maincategory_subcategory }}</option>  
                            @else
                                <option value="{{ $subcategory->id }}">{{ $subcategory->maincategory_subcategory }}</option>
                            @endif          
                        @endforeach
                    </select> 
                </div>
                <div class="col-sm-4">
                    <label for="sublocation_id">Location - Sublocation</label>
                    <select name="sublocation_id" id="sublocation_id" class="form-control">
                        @foreach ($sublocations as $sublocation)
                            @if ($sublocation->id == $asset->sublocation_id )
                                <option value="{{ $sublocation->id }}" selected="selected">{{ $sublocation->mainlocation_sublocation }}</option> 
                            @else
                                <option value="{{ $sublocation->id }}">{{ $sublocation->mainlocation_sublocation }}</option>  
                            @endif               
                        @endforeach
                    </select> 
                </div>
                <div class="col-sm-4">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control">
                        @foreach ($brands as $brand) 
                            @if ($brand->id == $asset->brand_id )
                                <option value="{{ $brand->id }}" selected="selected">{{ $brand->brand }}</option>     
                            @else
                                <option value="{{ $brand->id }}">{{ $brand->brand }}</option>     
                            @endif     
                        @endforeach
                    </select> 
                </div>
            </div>
            <div class="form-group">
                <label for="note">More Information (Note): </label>
                <textarea class="form-control" name="note" id="note" rows="4">{{ $asset->note }}</textarea>
            </div>
            <input type="submit" class="" value="Update" />
        </form>
    </div> 

@endsection