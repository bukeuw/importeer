<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Image;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use App\Product;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function importPage()
    {
        $products = Product::all();

        return view('import-page', compact('products'));
    }

    public function import(Request $request)
    {
        if ($request->hasFile('xls') && $request->file('xls')->isValid()) {
            $path = $request->xls->store('public/uploaded');
            Excel::import(new ProductImport, $path, 'local', \Maatwebsite\Excel\Excel::XLSX);
            return redirect('/');
        }

        return response()->json([
            'request' => $request->all(),
        ]);
    }

    public function importJson(Request $request)
    {
        if ($request->has('data')) {
            foreach ($request->data as $product) {
                Product::create($product);
            }

            return response()->json([
                'data' => $request->data,
            ]);
        }

        return response()->json([
            'error' => 'data field required'
        ], 422);
    }

    public function upload(UploadRequest $request)
    {
        $image = $request->image;

        if ($image->isValid()) {
            $imagePath = $image->store('public/images');
            $imageUrl = "/storage/$imagePath";
            Image::create([
                'product_id' => $request->product_id,
                'url' => $imageUrl,
            ]);

            return redirect('/')->with('message', 'Image uploaded');
        }

        return redirect('/');
    }

    public function uploadForm()
    {
        $products = Product::all();

        return view('image-upload', compact('products'));
    }

    public function view($productId)
    {
        $product = Product::findOrFail($productId);

        return view('product.detail', compact('product'));
    }
}
