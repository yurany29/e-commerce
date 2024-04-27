<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\UserRequest;


class UserController extends Controller
{
	public function index(Request $request)
	{
		$roles = Role::get();
		$users = User::with('roles')->get();
		if (!$request->ajax()) return view('users.index', compact('users', 'roles'));
		return response()->json(['Users' => $users], 200);
	}


	public function create()
	{
		//trae los roles para editar y crear
		// $roles = Role::all()->pluck('name');
		// return view( compact('roles'));
	}


	public function store(UserRequest $request)
	{
		dd($request->all());
		$user = new User($request->all());
		$user->save();
		$user->assignRole($request->role);
		if (!$request->ajax()) return back()->with('success', 'User crated');
		return response()->json(['status' => 'user created', 'User' => $user], 201);
	}


	public function show(Request $request, User $user)
	{
		if (!$request->ajax()) return view();
		return response()->json(['user' => $user], 200);
	}


	public function edit($id)
	{
		//trae los roles para editar y crear
		// $roles = Role::all()->pluck('name');
		// return view( compact('roles'));
	}

	public function update(UserRequest $request, User $user)
	{
		$user->update($request->all());
		$user->syncRoles([$request->role]);
		if (!$request->ajax()) return back()->with('success', 'User updated');
		return response()->json([], 204);
	}

	public function destroy(Request $request, User $user)
	{
		$user->delete();
		if (!$request->ajax()) return back()->with('success', 'User deleted');
		return response()->json([], 204);
	}
}
