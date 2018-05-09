<?php

namespace App\Http\Controllers;

use App\Slider;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('slider')->with(['sliders'=>$sliders]);
    }

    public function create(Request $request)
    {
        $this->Validate($request, [
            'name' => 'required|string',
            'body' => 'nullable|string',
            'head' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg',
        ]);

        $slider = new Slider(array(
            'name' => $request['name'],
            'body' => $request['body'],
            'head' => $request['head'],
        ));

        $slider->save();

        $file_name = $slider->id .'.jpg';
        $request->file('image')->move(public_path('img/slider/'), $file_name);

        return back();
    }

    public function delete($id)
    {
        $slider = Slider::FindOrFail($id);
        $file_path = public_path('img/slider/').$slider->id.'.jpg';
        unlink($file_path);
        $slider -> delete();
        return back();
    }
}
