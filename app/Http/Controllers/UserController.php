<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
  public function index()
  {
    $users = User::paginate(15);
    return view('pages.admin.user.index', compact('users'));
  }

  public function viewProfile()
  {
    $user = Auth::user();
    return view('pages.users.my-profile', compact('user'));
  }

  public function viewProfileAdmin()
  {
    $user = Auth::user();
    return view('pages.admin.profile', compact('user'));
  }

  /**
   * Menampilkan halaman edit data user yang sedang login.
   *
   * @return \Illuminate\View\View
   */
  public function editProfile()
  {
    $user = Auth::user();
    return view('user.edit', compact('user'));
  }

  public function show($email)
  {
    $user = User::findOrFail($email);
    return view('pages.admin.user.show', compact('user'));
  }

  public function create()
  {
    return view('pages.admin.user.add');
  }

  public function store(Request $request)
  {
    $request->validate([
      'email'         => 'required|email|unique:users_222405,email_222405',
      'name'          => 'required|string|max:255',
      'password'      => 'required|string|min:6|confirmed',
      'role'          => 'required|string',
      'gender'        => 'nullable|string',
      'address'       => 'nullable|string',
      'phone'         => 'nullable|string',
      'birth_date'    => 'nullable|date',
      'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    $profilePhotoPath = null;
    if ($request->hasFile('profile_photo')) {
      $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
    }

    User::create([
      'email_222405'         => $request->input('email'),
      'name_222405'          => $request->input('name'),
      'password_222405'      => Hash::make($request->input('password')),
      'role_222405'          => $request->input('role'),
      'gender_222405'        => $request->input('gender'),
      'address_222405'       => $request->input('address'),
      'phone_222405'         => $request->input('phone'),
      'birth_date_222405'    => $request->input('birth_date'),
      'profile_photo_222405' => $profilePhotoPath,
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
  }

  public function edit($email)
  {
    $user = User::findOrFail($email);
    return view('pages.admin.user.update', compact('user'));
  }

  public function update(Request $request, $email)
  {
    $user = User::findOrFail($email);

    $request->validate([
      'name'          => 'required|string|max:255',
      'password'      => 'nullable|string|min:6|confirmed',
      'role'          => 'required|string',
      'gender'        => 'nullable|string',
      'address'       => 'nullable|string',
      'phone'         => 'nullable|string',
      'birth_date'    => 'nullable|date',
      'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    if ($request->hasFile('profile_photo')) {
      if ($user->profile_photo_222405 && Storage::exists('public/' . $user->profile_photo_222405)) {
        Storage::delete('public/' . $user->profile_photo_222405);
      }
      $profilePhotoPath           = $request->file('profile_photo')->store('profile_photos', 'public');
      $user->profile_photo_222405 = $profilePhotoPath;
    }

    $user->name_222405       = $request->input('name');
    $user->role_222405       = $request->input('role');
    $user->gender_222405     = $request->input('gender');
    $user->address_222405    = $request->input('address');
    $user->phone_222405      = $request->input('phone');
    $user->birth_date_222405 = $request->input('birth_date');

    if ($request->filled('password')) {
      $user->password_222405 = Hash::make($request->input('password'));
    }

    $user->save();

    return redirect()->back()->with('success', 'User updated successfully.');
  }

  public function destroy($email)
  {
    $user = User::findOrFail($email);

    if ($user->profile_photo_222405 && Storage::exists('public/' . $user->profile_photo_222405)) {
      Storage::delete('public/' . $user->profile_photo_222405);
    }

    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
  }

  public function updateProfile(Request $request)
  {
    $userId = Auth::user()->email_222405;
    $user   = User::findOrFail($userId);

    $request->validate([
      'name'          => 'required|string|max:255',
      'email'         => 'required|email|unique:users_222405,email_222405,' . $userId . ',email_222405',
      'gender'        => 'nullable|in:male,female',
      'address'       => 'nullable|string|max:255',
      'phone'         => 'nullable|string|max:20',
      'birth_date'    => 'nullable|date',
      'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user->name_222405       = $request->input('name');
    $user->email_222405      = $request->input('email');
    $user->gender_222405     = $request->input('gender');
    $user->address_222405    = $request->input('address');
    $user->phone_222405      = $request->input('phone');
    $user->birth_date_222405 = $request->input('birth_date');

    if ($request->hasFile('profile_photo')) {
      if ($user->profile_photo_222405 && file_exists(storage_path('app/public/' . $user->profile_photo_222405))) {
        unlink(storage_path('app/public/' . $user->profile_photo_222405));
      }

      $path                       = $request->file('profile_photo')->store('profile_photos_222405', 'public');
      $user->profile_photo_222405 = $path;
    }

    $user->save();

    return redirect()->back()->with('success', 'User updated successfully.');
  }
}
