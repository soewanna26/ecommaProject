@extends('admin.layout.app')
@section('title', 'Category')

@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('message')
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="card-title" style="margin: 0;">Category</h4>
                    <a href="{{ route('admin.add_category') }}" style="text-decoration: none;">Add Category</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->isNotEmpty())
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->category_name }}</td>
                                        <td> {{ \Carbon\Carbon::parse($category->created_at)->format('d M,Y') }} </td>
                                        <td>
                                            <a href="{{ route('admin.edit_category', $category->id) }}"
                                                class="btn btn-info btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('admin.delete_category', $category->id) }}"
                                                onclick="return confirm('Are you sure you want to delete {{ $category->category_name }}?')"
                                                class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div>
                        @if ($categories->isNotEmpty())
                            {{ $categories->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
