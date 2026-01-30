<?php

namespace App\Services\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserService
{
    public function getAllUsers(Request $request)
    {
      $perPage = (int) $request->input('perPage', 10);
      $search = $request->input('search');
      $role = $request->input('role');

      $query = User::query();

      if (!empty($search)) {
        $query->whereLike('username', "%{$search}%");
      }

      if (!empty($role)) {
        $query->where('role', Str::lower($role));
      }

      return $query->paginate($perPage);
    }

    public function createUser(array $data)
    {
      return User::create([
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'role' => Str::lower($data['role']),
      ]);
    }

    public function updateUser(int $id, array $data)
    {
      $user = User::findOrFail($id);
      $user->update($data);

      return $user;
    }

    public function deleteUser(int $id)
    {
      $user = User::findOrFail($id);

      return $user->delete();
    }
}
