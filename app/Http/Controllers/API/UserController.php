<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(){

        $this->middleware('auth:api');

    }

    public function index()
    {
        return User::latest()->paginate(2);
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'type' => 'required',
        ]);

        return User::create([
           'name' => $request['name'],
           'email' => $request['email'],
           'password' => \Hash::make($request['password']),
           'type' => $request['type'],
        ]);
    }

    public function show($id)
    {
        //
    }
     public function profile()
    {
        return auth('api')->user();
    }
   
    public function updateProfile(Request $request)
    { 
        $user = auth('api')->user();

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6'
        ]);

        $currentPhoto = $user->photo;

        if($request->photo != $currentPhoto){

            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;

            if(file_exists($userPhoto)){

                @unlink($userPhoto);
                
            }
        }

        if(!empty($request->password)){

            $request->merge(['password' => \Hash::make($request['password'])]);
        }

        $user->update($request->all());

        return ['message' => "Success"];

       
    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'type' => 'required',
        ]);

        $user = User::findOrFail($id);

        $user->update($request->all());
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
         'message' => 'User deleted successfully'
        ]);
    }

    public function search(){

        if ($search = \Request::get('q')) {

        $users = User::where(function($query) use ($search){

            $query->where('name','LIKE',"%$search%")

                    ->orWhere('email','LIKE',"%$search%")
                    ->orWhere('id','LIKE',"%$search%");
                    
            })->paginate(3);

        }else{
            $users = User::latest()->paginate(3);
        }

        return $users;
    }
}
