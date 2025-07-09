<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/termCondition';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'], // Validation for username
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validate image
        ]);
    }

    protected function create(array $data)
    {
        $profilePicturePath = null;

        // Handle profile picture upload
        if (isset($data['profile_picture'])) {
            // Store the profile picture in the 'assets/profile_pictures' directory
            $file = $data['profile_picture'];
            $filename = time() . '_' . $file->getClientOriginalName(); // Use the same style as your cover_image logic
            $file->move(public_path('assets/profile_pictures'), $filename); // Move the file to the desired directory
            $profilePicturePath = 'assets/profile_pictures/' . $filename; // Save the relative path
        }

        return User::create([
            'name' => $data['name'],
            'username' => $data['username'], 
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_picture' => $profilePicturePath, // Save the profile picture path
        ]);
    }
}


