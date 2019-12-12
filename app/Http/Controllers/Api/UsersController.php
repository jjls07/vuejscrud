<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UsersController extends Controller
{
    public function index()
    {
      $users = DB::table('users')
      ->join('roles', 'roles.id', '=', 'users.role_id')
      ->select('users.id', 'users.name',
      'users.email',
      'roles.name as role_id')
      ->get();

      $users = User::paginate(10);
      return UserResource::collection($users);
        //return UserResource::collection(User::paginate(10));
    }

    public function show(User $user)
{
    return new UserResource($user);
}
  public function update(User $user, Request $request)
  {
      $data = $request->validate([
          'name' => 'required',
          'email' => 'required|email',
          'role_id' => 'required',
      ]);

      $user->update($data);

      return new UserResource($user);
}

public function destroy(User $user)
{
    $user->delete();

    return response(null, 204);
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required|min:8',
        'role_id' => 'required',
    ]);

    return new UserResource(User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'role_id' => $data['role_id'],
    ]));
}


}
