<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatalogProduct;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('ensureTokenIsValid');
    }
    public function index()
    {
        $products = CatalogProduct::all();
        return response()->json($products);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
        ]);

        $product = CatalogProduct::create($request->all());

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = CatalogProduct::findOrFail($id);
        return response()->json($product);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'height' => 'sometimes|required|numeric',
            'length' => 'sometimes|required|numeric',
            'width' => 'sometimes|required|numeric',
        ]);

        $product = CatalogProduct::findOrFail($id);
        $product->update($request->all());

        return response()->json($product);
    }

    public function delete($id)
    {
        $product = CatalogProduct::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}
