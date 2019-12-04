<?php
namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use DataTables;

class CompanyController extends Controller
{
  public function index()
  {
    $company = Company::latest()->get();

    return view('company.index', compact('company'));
  }

  public function view()
  {
    return view('company.store');
  }

  public function Store(Request $request)
  {
    Company::updateOrCreate(
      [
        'id' => $request->id
      ],
      [
        'name' => $request->name,
        'address' => $request->address
      ]
    );

    return response()->json(
      [
        'success' => true,
        'message' => 'Data inserted successfully'
      ]
    );
  }

  public function destroy($id)
  {
    $company = Company::find($id);

    $company->delete();

    return response()->json([
      'message' => 'Data deleted successfully!'
    ]);
  }

  public function update($id)
  {
    $comapny  = Company::find($id);

    return response()->json([
      'data' => $comapny
    ]);
  }
}
