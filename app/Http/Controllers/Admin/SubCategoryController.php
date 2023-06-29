<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function display(Request $request)
    {
        //$products = CategoryModel::latest()->paginate(5);
        //return view('layouts.product.category', compact('products'));
        return view('layouts.product.sub_category');
    }
}
