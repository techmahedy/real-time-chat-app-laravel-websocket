<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    

    public function index()
    {
        $categories = Category::latest()->get();

        return response()->json([
           "categories" => $categories
        ],200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Category::create([
          'name' => $request->name,
          'slug' => \Str::slug($request->name,'-'),
          'status' => $request->status
        ]);

        return ["data" => "Success"];
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
