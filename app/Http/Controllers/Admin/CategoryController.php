<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function display(Request $request)
    {
        $products = CategoryModel::latest()->paginate(5);
        return view('layouts.product.category', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        CategoryModel::create([
            'category_name' => $request->name,
            'slug' => '-',
            'image' => 'pth'
        ]);

        return response()->json([
            'success' => 'Data Saved Successfully'], 201);
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        CategoryModel::where('id', $request->idno)->update([
            'category_name' => $request->name,
            'slug' => '-',
            'image' => 'pth'
        ]);



        return response()->json([
            'success' => 'Data Update Successfully'], 201);
    }

    public function delete(Request $request)
    {
        CategoryModel::find($request->iid)->delete();
        return response()->json(['success' => 'Data Delete Successfully'], 201);
    }

    public function paginate(Request $request)
    {
        $products = CategoryModel::latest()->paginate(5);
        return view('layouts.product.category_pagi', compact('products'))->render();
    }

    public function search(Request $request)
    {
        $products = CategoryModel::where("category_name", 'like', '%'.$request->txt.'%')
            ->orderby('id', 'DESC')->paginate(5);
            if($products->count() >=1){
                return view('layouts.product.category_pagi', compact('products'))->render();
            } else {
                return response()->json([
                    'status' => 'Nothing Found'], 201);
            }
    }

}
