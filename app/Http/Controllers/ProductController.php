<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Products::all();
        return view('products.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $validate = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'canteen_id' => 'required',
        ]);

        Products::create($validate);

        return redirect()->back()->with('success', 'Product created successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'canteen_id' => 'required',
            'product' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('product')) {
            $product = $request->file('product');
            $product_name = time() . '.' . $product->getClientOriginalExtension();
            $product->move(public_path('storage/product'), $product_name);

            $validate['product'] = $product_name;
        }

        Products::create($validate);

        return redirect()->back()->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Products::find($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'canteen_id' => 'required',
            'product' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('product')) {
            $product = $request->file('product');
            $product_name = time() . '.' . $product->getClientOriginalExtension();
            $product->move(public_path('storage/product'), $product_name);

            $validate['product'] = $product_name;
        }

        Products::find($id)->update($validate);

        return redirect()->back()->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Products::find($id)->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
