<?php

namespace App\Http\Controllers;

use App\Config;
use App\Notification;
use App\Slider;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    static function NumberFormat($vars)
    {
        $array = ['loan','payment','loan_payment','loan_payment_force','payment_cost','expense','instalment','instalment_force','sum','fee','tote'];
        foreach ($array as $par){
            foreach ($vars as $var) {
                if (isset($var->$par)) {
                    $var->$par = number_format($var->$par);
                }
            }
        }
        return $vars;
    }

    public function welcome()
    {
        $sliders = Slider::all();
        $notifications = Notification::all()->sortByDesc('created_at');
        $config_top =Config::where('type','=','top_h')->first();
        $config_down =Config::where('type','=','down_h')->first();
        $config_laws =Config::where('type','=','law')->get();
        $config_hours =Config::where('type','=','hour')->get();
        return view('welcome')->with([
            'sliders'=>$sliders,'notifications'=>$notifications,'config_top'=>$config_top,'config_down'=>$config_down,
            'config_laws'=>$config_laws,'config_hours'=>$config_hours
        ]);
    }
}
