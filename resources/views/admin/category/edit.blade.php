@extends('admin.layout.app')
@section('title', 'Category Edit')

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Category Edit</h4>
                <form class="forms-sample" action="{{ route('admin.update_category',$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text"
                            class="form-control @error('category_name')
                            is-invalid
                        @enderror"
                            id="category_name" placeholder="Category Name" name="category_name"
                            value="{{ old('category_name',$category->category_name) }}">
                        @error('category_name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a class="btn btn-dark" href="{{ route('admin.category') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
