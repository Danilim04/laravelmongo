<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doc;


class SheetController extends Controller
{
    public function ApiSheets (Request $request) {
            $docs = Doc::where('ar', '55231066438011000166005338304')->get();
            dd($docs);
    }
}
