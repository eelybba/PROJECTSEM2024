<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::all();
        /**If inventory is low in stock, return alert message */
        $alert = Product::where('product_quantity', '<=', 5)->get();

        if (count($alert) <= 0) {
            $alert = null;
        }
        return view('products.viewInventory', compact('products', 'alert'));
    }

    /**
     * Show the form for adding a new product.
     */
    public function create()
    {
        return view('products.addInventory');
    }

    /**
     * Store a newly added product in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'product_id' => 'required|unique:products',
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        // Create a new product
        $product = new Product();
        $product->product_id = $request->product_id;
        $product->product_name = $request->name;
        $product->product_cost = number_format($request->cost, 2, '.', '');
        $product->product_price = number_format($request->price, 2, '.', '');
        $product->product_quantity = $request->quantity;
        $product->product_category = $request->category;
        $product->product_brand = $request->brand;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product added successfully');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.updateInventory', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'product_id' => 'required|unique:products,product_id,' . $id,
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        // Update product
        $product = Product::find($id);
        $product->product_id = $request->product_id;
        $product->product_name = $request->name;
        $product->product_cost = number_format($request->cost, 2, '.', '');
        $product->product_price = number_format($request->price, 2, '.', '');
        $product->product_quantity = $request->quantity;
        $product->product_category = $request->category;
        $product->product_brand = $request->brand;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }

    /**
     * Search for products.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Search for products
        $products = Product::where('product_name', 'LIKE', "%{$query}%")
                            ->orWhere('product_category', 'LIKE', "%{$query}%")
                            ->orWhere('product_brand', 'LIKE', "%{$query}%")
                            ->get();
        
        // Check for low stock alerts
        $alert = Product::where('product_quantity', '<=', 5)->get();
        if (count($alert) <= 0) {
            $alert = null;
        }

        return view('products.viewInventory', compact('products', 'alert'));
    }
}



