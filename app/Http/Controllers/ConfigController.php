<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function show()
    {
        $configs = Config::all()->sortBy('type');
        return view('config_panel')->with(['configs'=>$configs]);
    }
    public function delete(Request $request)
    {
        $config = Config::FindOrFail($request->id);
        $config->delete();
        return back();
    }

    public function post(Request $request)
    {
        if ($request->has('id')){
            $config = Config::FindOrFail($request->id);
        }else{
            $config = new Config;
            $config->type = $request->type;
        }
        $config->text = $request->text;
        $config -> save();
        return back();
    }
}
