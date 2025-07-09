<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivacyController extends Controller
{
public function updatePrivacy(Request $request)
{
    $request->validate([
        'privacy_setting' => 'required',
    ]);

        $user = Auth::user();
        $user->privacy_setting = $request->privacy_setting;
        $user->save();

    return response()->json(['message' => 'Privacy setting Changed successfully.']);
}
    }

