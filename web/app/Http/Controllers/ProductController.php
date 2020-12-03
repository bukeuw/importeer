<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductImport;
use App\Product;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function importPage()
    {
        return view('import-page');
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
}
