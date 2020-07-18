@extends('layouts.app')

@section('content')
    <div class="container">                     
        <h1>Add A New Subcategory:</h1>  
        <hr />
        <form action="{{ route('subcategories.store') }}" method="POST"> 
                <!-- csrf will prevent cross-browser submission
                csrf_field() will create hidden field with token values in the form
                so the form can be submitted successfully to the database
                -->
                {{ csrf_field() }} 

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                    </select>
                </div>
                <label for="subcategory">Subcategory: </label>
                <input type="text" name="subcategory" id="subcategory" class="form-control @error('subcategory') is-invalid @enderror" />    
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