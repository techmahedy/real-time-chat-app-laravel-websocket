<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    


    public function index()
    {
        return Permission::latest()->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Permission::create([
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
