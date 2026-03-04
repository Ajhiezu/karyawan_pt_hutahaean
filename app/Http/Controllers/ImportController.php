<?php

namespace App\Http\Controllers;

use App\Imports\KaryawanImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new KaryawanImport, $request->file('file'));

        return back()->with('success', 'Data berhasil diimport');
    }
}
