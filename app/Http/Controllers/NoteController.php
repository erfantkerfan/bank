<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $users = User::where('note', '!=', null)->orwhere('user_note', '!=', null)->OrderBy('acc_id')->paginate(20);
        return view('notes')->with(['users'=>$users]);

    }

    public function user_note(Request $request)
    {
        $user_id = basename(url()->previous());

        if (($user_id) == 'home') {
            $user_id = Auth::user()->id;
        }

        $user = User::FindOrFail($user_id);
        $user -> user_note = $request -> user_note;
        $user -> save();
        return back();
    }
}
