<?php

namespace App\Http\Controllers;

use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $users = User::where('note', '!=', null)->orWhere('user_note', '!=', null)
            ->orderBy('user_note_date','desc')
            ->orderBy('note_date', 'desc')->paginate(20);

        return view('notes', compact('users'));
    }

    public function user_note(Request $request)
    {
        $user_id = strtok(basename(url()->previous()), '?');

        if (($user_id) == 'home') {
            $user_id = auth()->id();
        }

        $user = User::query()->findOrFail($user_id);
        $user->user_note = $request->user_note;
        $user->user_note_date = Verta::now();
        $user->save();

        return back();
    }

    public function delete($id)
    {
        $user = User::query()->findOrFail($id);
        $user->note = null;
        $user->note_date = null;
        $user->save();

        return back();
    }

    public function delete_user($id)
    {
        $user = User::query()->findOrFail($id);
        $user->user_note = null;
        $user->user_note_date = null;
        $user->save();

        return back();
    }
}
