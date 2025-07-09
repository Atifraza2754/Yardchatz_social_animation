<?php

namespace App\Http\Controllers;

use App\Models\Text;
use App\Models\User;
use App\Models\Video;
use App\Models\Audios;
use App\Models\Stills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Get All User
    public function users()
    {
        $users = User::where('id','!=' , Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();
        return view('frontend.users', compact('users'));
    }

    //view single/other user profile
    public function view_profile($id)
    {
        
        $user = User::findOrFail($id);
        $videos = Video::with('user')->where('user_id', $id)->get();
        $audio  = Audios::with('user')->where('user_id', $id)->get();
        $stills  = Stills::with('user')->where('user_id', $id)->get();
        $text  = Text::with('user')->where('user_id', $id)->get();
        
       $channel = 'user_' . $user->id;  // Channel identifier
        return view('frontend.user_profile', compact('user', 'videos', 'audio', 'stills', 'text', 'channel'));
    }

    //get logged in user for person page
    public function person()
    {
        $user = auth()->user();
        return view('frontend.person',compact('user'));
    }
    
    //update auth user details in person page
    public function updatePerson(Request $request)
    {
        $request->validate([
        'field' => 'required|string',
        'value' => 'required|string',
        ]);

        $user = auth()->user();

        $user->{$request->field} = $request->value;
        $user->save();

         return response()->json(['success' => true]);
    }

    //auth usr upload cover pic
    public function uploadCover(Request $request)
    {
        $request->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        $file = $request->file('cover_image');
        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('storage/cover_images'), $filename);

        $user->cover_image = 'storage/cover_images/' . $filename;
        $user->save();

        return response()->json([
            'success' => true,
            'image_url' => asset($user->cover_image),
        ]);
    }

    //get auth user data on setting page
    public function setting(){
        $user = Auth::user();
        return view('frontend.setting', compact('user'));
    }

    //update user details from setting page
    public function updateSettings(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'workplace' => ['nullable', 'string', 'max:255'],
            'school' => ['nullable', 'string', 'max:255'],
            'Pensacola' => ['nullable', 'string', 'max:255'],
            'dob' => ['nullable', 'date'],
            'loves' => ['nullable', 'string', 'max:255'],
            'home_town' => ['nullable', 'string', 'max:255'],
            'current_city' => ['nullable', 'string', 'max:255'],
            'favorite_song' => ['nullable', 'string', 'max:255'],
            'employer' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
        ]);

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        // Set new fields
        $user->workplace = $request->input('workplace');
        $user->school = $request->input('school');
        $user->Pensacola = $request->input('Pensacola');
        $user->dob = $request->input('dob');
        $user->loves = $request->input('loves');
        $user->home_town = $request->input('home_town');
        $user->current_city = $request->input('current_city');
        $user->favorite_song = $request->input('favorite_song');
        $user->employer = $request->input('employer');
        $user->job_title = $request->input('job_title');

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && File::exists(public_path($user->profile_picture))) {
                File::delete(public_path($user->profile_picture));
            }

            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/profile_pictures'), $filename);
            $user->profile_picture = 'assets/profile_pictures/' . $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    //update password from setting page
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

    // add id_card
    public function uploadIdCard(Request $request)
    {
        $request->validate([
            'id_card' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('id_card');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Make sure folder exists
        $destinationPath = public_path('assets/ID_Card_Images');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $file->move($destinationPath, $filename);

        auth()->user()->update([
            'id_card' => 'assets/ID_Card_Images/' . $filename,
        ]);

        return redirect()->route('yardcharz')->with('success', 'ID Card uploaded successfully.');
    }


}
