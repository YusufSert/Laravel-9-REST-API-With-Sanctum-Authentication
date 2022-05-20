<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    //
    public function addSubCategory(Request $request) {
        $request->validate([
            'category_id' => 'required|exists:App\Models\Category,id',
            //'category_id' => 'required',
        ]);
        return response('gf');
    }
}
