@extends('admin.layout.app')
@section('title', 'Product Create')

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Product Create</h4>
                <form class="forms-sample" action="{{ route('admin.store_product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Category</label>
                        <select
                            class="js-example-basic-single form-control @error('category_id')
                            is-invalid
                        @enderror"
                            style="width:100%" name="category_id">
                            <option value="" selected disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" value="{{ old('title') }}"
                            class="form-control @error('title')
                            is-invalid
                        @enderror"
                            id="title" name="title">
                        @error('title')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" value="{{ old('quantity') }}"
                            class="form-control @error('quantity')
                            is-invalid
                        @enderror"
                            id="quantity" name="quantity">
                        @error('quantity')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" value="{{ old('price') }}"
                            class="form-control @error('price')
                        is-invalid
                    @enderror"
                            id="price" name="price">
                        @error('price')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount_price">Discount Price</label>
                        <input type="text" value="{{ old('discount_price') }}" class="form-control" id="discount_price" name="discount_price">
                    </div>
                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="image" class="file-upload-default" accept="image/*">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="4" name="description">{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a class="btn btn-dark" href="{{ route('admin.product') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('customJs')
    <script type="text/javascript">
        (function($) {
            'use strict';

            if ($(".js-example-basic-single").length) {
                $(".js-example-basic-single").select2();
            }
        })(jQuery);
        (function($) {
            'use strict';
            $(function() {
                $('.file-upload-browse').on('click', function() {
                    var file = $(this).parent().parent().parent().find('.file-upload-default');
                    file.trigger('click');
                });
                $('.file-upload-default').on('change', function() {
                    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i,
                        ''));
                });
            });
        })(jQuery);
    </script>
@endsection
