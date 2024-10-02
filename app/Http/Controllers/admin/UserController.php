<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class UserController extends Controller
{
public function adminLogin(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Authentication passed...
        return redirect()->route('dashboard');

    }
    return back()->withErrors([
        'error' => 'The provided credentials do not match our records.',
    ]);
}

public function addUser(Request $request)
{
    // Validate the form data
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        // 'file' => 'required|file|mimes:jpg,png,pdf|max:2048', // Adjust the file validation rules as needed
    ]);

    // Handle file upload
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
    }

    // Create a new user record
    $user = new User();
    $user->email = $request->email;
    $user->password = Hash::make($request->password); // Hash the password
    $user->save();

    // Redirect or return a response
    return redirect()->back()->with('success', 'User added successfully!');
}

public function showUser(Request $request)
{
    $users = User::all();
    return view('admin.user.showUser', compact('users'));

}

public function editUser($id)
{
    $user = User::find($id);
    return view('admin.user.updateUser', compact('user'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min=6',
    ]);

    $user = User::find($id);
    if ($user) {
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.user.show')->with('success', 'User updated successfully');
    }
    return redirect()->route('user.show')->with('error', 'User not found');
}

public function deleteUser($id)
{
    $user = User::find($id);
    if ($user) {
        $user->delete();
        return redirect()->route('adminuser.show')->with('success', 'User deleted successfully');
    }
    return redirect()->route('admin.user.show')->with('error', 'User not found');
}
}