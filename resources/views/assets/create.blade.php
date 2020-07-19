@extends('layouts.app')

@section('content')
    <div class="container">                     
        <h1>Add A New Asset:</h1>  
        <hr />
        <form action="{{ route('assets.store') }}" method="POST"> 
                <!-- csrf will prevent cross-browser submission
                csrf_field() will create hidden field with token values in the form
                so the form can be submitted successfully to the database
                -->
                {{ csrf_field() }} 

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="brand_id">Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                            @endforeach
                        </select> 
                    </div>
                    
                    <div class="col-sm-6">
                        <label for="sublocation_id">Location - Sublocation</label>
                        <select name="sublocation_id" id="sublocation_id" class="form-control">
                             @foreach ($sublocations as $sublocation)
                                <option value="{{ $sublocation->id }}">{{ $sublocation->mainlocation_sublocation }}</option>
                            @endforeach
                        </select> 
                    </div>
                </div>
                <label for="asset">Asset: </label>
                <input type="text" name="asset" id="asset" class="form-control @error('asset') is-invalid @enderror" />    
                @error('subcategory')
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