<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Payment;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('notification', compact('notifications'));
    }

    public function create(Request $request)
    {
        $notification = new Notification;
        $notification->text = $request->notification;
        $notification->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $notification = Notification::query()->findOrFail($id);
        $notification->delete();
        return redirect()->back();
    }
}
