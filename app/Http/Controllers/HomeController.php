<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Faker\Provider\Image;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function user()
    {
        $users = \App\User::whereNotIn('id', [1])->get();
        
        return view('user', compact('users'));
    }
    
    public function userDownloads($id)
    {
        if (!$user = User::find($id)) {
            return response(['error' => 'user not found'], 400);
        }

        $files = Storage::disk('dropbox')->files($user->email . '_' . $user->phone . '_' . $user->name);

        return view('downloads', compact('files'));
    }

    public function image($dirName, $filename)
    {
        if (!Storage::disk('dropbox')->has($dirName . '/' . $filename)) {
            abort(404);
        }
        $file = Storage::disk('dropbox')->get($dirName . '/' . $filename);

        $response = Response::make($file, 200);
        
        return $response;
    }

    public function download($dirName, $filename)
    {
        if (!Storage::disk('dropbox')->has($dirName . '/' . $filename)) {
            abort(404);
        }
        $file = Storage::disk('dropbox')->get($dirName . '/' . $filename);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        return $file;
    }
}