<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->paginate(9);
        return view('admin.product.list', [
            'products' => $products
        ]);
    }

    public function add_product()
    {
        $categories = Category::get();
        return view('admin.product.create', [
            'categories' => $categories
        ]);
    }

    public function store_product(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.add_product')->withInput()->withErrors($validator);
        }

        // Debugging: Log the request data

        // Create a new Product instance
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->description = $request->description;

        // Save the product to the database
        $product->save();

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext;

            // Ensure the upload directory exists
            if (!File::exists(public_path('adm/uploads/product'))) {
                File::makeDirectory(public_path('adm/uploads/product'), 0755, true);
            }

            // Delete existing product image if it exists
            if (File::exists(public_path('adm/uploads/product/' . $product->image))) {
                File::delete(public_path('adm/uploads/product/' . $product->image));
            }

            // Move the new image
            $image->move(public_path('adm/uploads/product'), $imageName);
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('admin.product')->with('success', 'Product added successfully');
    }

    public function edit_product(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::get();
        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // Validate the request
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.add_product')->withInput()->withErrors($validator);
        }

        // Debugging: Log the request data

        // Create a new Product instance

        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->description = $request->description;

        // Save the product to the database
        $product->save();

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext;

            // Delete existing product image if it exists
            if (File::exists(public_path('adm/uploads/product/' . $product->image))) {
                File::delete(public_path('adm/uploads/product/' . $product->image));
            }

            // Move the new image
            $image->move(public_path('adm/uploads/product'), $imageName);
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('admin.product')->with('success', 'Product updated successfully');
    }

    public function delete_product(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        // Delete existing Room image (if it exists)
        if (File::exists(public_path('adm/uploads/product/' . $product->image))) {
            File::delete(public_path('adm/uploads/product/' . $product->image));
        }
        $product->delete();
        return redirect()->route('admin.product')->with('success', 'Product deleted successfully');
    }
}
