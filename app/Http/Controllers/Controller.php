<?php

namespace App\Http\Controllers;

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
        $array = ['loan','payment','loan_payment','loan_payment_force','payment_cost','expense','instalment','instalment_force'];
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
        return view('welcome')->with(['sliders'=>$sliders]);
    }
}
