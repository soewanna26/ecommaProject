<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Ramsey\Uuid\v1;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('category_name', 'DESC')->paginate(9);
        return view('admin.category.list', [
            'categories' => $categories
        ]);
    }

    public function add_category()
    {
        return view('admin.category.create');
    }

    public function store_category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.add_category')->withInput()->withErrors($validator);
        }

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        return redirect()->route('admin.category')->with('success', 'Category added successfully');
    }

    public function edit_category(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    public function update_category(Request $request,$id)
    {
        $category = Category::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.edit_category')->withInput()->withErrors($validator);
        }

        $category->category_name = $request->category_name;
        $category->save();

        return redirect()->route('admin.category')->with('success', 'Category updated successfully');
    }

    public function delete_category(Request $request,$id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category')->with('success','Category deleted successfully');
    }
}
