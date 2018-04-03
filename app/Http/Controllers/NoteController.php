<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $users = User::where('note', '!=', null)->paginate(20);
        return view('notes')->with(['users'=>$users]);

    }

    public function delete($id)
{
    $user = User::FindOrFail($id);
    $user->note = null;
    $user->save();
    return redirect()->back();
}
}
