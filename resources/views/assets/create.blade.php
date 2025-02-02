@extends('layouts.app')

@section('content')
    <div class="container">    
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif     
        <div align="right">
            <a href="{{ route('assets.index') }}" class="btn btn-default">Back</a>
        </div>    

        <h1>Add A New Asset:</h1>  
        <hr />
        <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data"> 
                <!-- csrf will prevent cross-browser submission
                csrf_field() will create hidden field with token values in the form
                so the form can be submitted successfully to the database
                -->
                @csrf 
                <label for="asset">Asset: </label>
                <input type="text" name="asset" id="asset" class="form-control @error('asset') is-invalid @enderror" />    
                @error('asset')
                    <span class="invalid-feedback font-weight-bold text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <br />

                <div class="form-group row">
                    <div class="col-sm-6">  
                        <label for="subcategory_id">Main Category - Subcategory</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                             <option disabled selected value> -- select an option -- </option>
                             @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->maincategory_subcategory }}</option>
                             @endforeach
                        </select> 
                    </div>
                    <div class="col-sm-4 text-center">
                        <br /><br />
                        <div class="custom-control custom-checkbox ">
                            <input type="checkbox" class="custom-control-input" name="has_tag" id="has_tag" >
                            <label class="custom-control-label" for="has_tag" >Has Tag</label>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="sublocation_id">Location - Sublocation</label>
                        <select name="sublocation_id" id="sublocation_id" class="form-control">
                             <option disabled selected value> -- select an option -- </option>
                              @foreach ($sublocations as $sublocation)
                                <option value="{{ $sublocation->id }}">{{ $sublocation->mainlocation_sublocation }}</option>
                              @endforeach
                        </select> 
                    </div>
                    <div class="col-sm-6">
                        <label for="brand_id">Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option disabled selected value> -- select an option -- </option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                            @endforeach
                        </select> 
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="col-md-4 text-right">Select Profile Image</label>
                        <div>
                            <input type="file" name="image" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="note">More Information (Note): </label>
                        <textarea class="form-control" name="note" id="note" rows="4"></textarea>
                    </div>
                </div>



                <br />
                <input type="submit" class="btn btn-primary" value="Add" />
            </form>
    </div>
@endsection