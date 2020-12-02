<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductImport;
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
}
