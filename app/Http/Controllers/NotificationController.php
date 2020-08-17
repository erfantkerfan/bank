<?php

namespace App\Http\Controllers;

use App\Notification;
use App\payment;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('notification')->with(['notifications' => $notifications]);
    }

    public function create(request $request)
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
