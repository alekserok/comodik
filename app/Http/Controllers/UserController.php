<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function loadImage(Request $request)
    {
        $user = Auth::getUser();

        if (!$image = $request->file('file')) {
            return response(['error' => 'image absent'], 400);
        }

        Storage::disk('dropbox')->put(
            $user->email . '_' . $user->phone . '_' . $user->name . '/' . str_random(6) . '_' . $image->getClientOriginalName(),
            file_get_contents($image->getRealPath())
        );
        return response(['status' => 'ok']);
    }
}
